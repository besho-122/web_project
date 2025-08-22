function showFeedback() {
      document.getElementById('feedback').style.display = 'block';
    }
document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', function () {
    document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
    this.classList.add('active');
  });
});



window.addEventListener("DOMContentLoaded", function () {
  const iframe = document.getElementById('api-frame');
  if (!iframe) {
    console.warn('iframe with id="api-frame" not found.');
    return;
  }

  const client = new Sketchfab(iframe);
  let apiInstance = null;

  const targetMaterialName = "paint";

  client.init('d01b254483794de3819786d93e0e1ebf', {
    autostart: 1,
    preload: 1,
    transparent: 1,         
    ui_theme: 'light',
    ui_animations: 0,
    ui_infos: 0,
    ui_stop: 0,
    ui_inspector: 0,
    ui_watermark_link: 0,
    ui_watermark: 0,
    ui_hint: 0,
    ui_ar: 0,
    ui_help: 0,
    ui_settings: 0,
    ui_vr: 0,
    ui_annotations: 0,
    dnt: 1,
    ui_fullscreen: 0,

    success: function (api) {
      apiInstance = api;
      api.start();

      api.addEventListener('viewerready', function () {
      
        if (typeof api.setBackground === 'function') {
          api.setBackground({ transparent: true });
        }


        api.getMaterialList(function (err, materials) {
          if (err) return console.error(err);

        });

        console.log('Sketchfab viewer is ready with transparent background.');
      });
    },

    error: function () {
      console.error('Sketchfab API initialization error');
    }
  });

  window.changeColor = function (rgbArray) {
    if (!apiInstance) return;

    apiInstance.getMaterialList(function (err, materials) {
      if (err) {
        console.error(err);
        return;
      }

      const mat = materials.find(m =>
        m.name && m.name.toLowerCase().includes(targetMaterialName)
      );

      if (mat && mat.channels && mat.channels.AlbedoPBR) {
        mat.channels.AlbedoPBR.color = rgbArray; 
        apiInstance.setMaterial(mat);
      } else {
        console.warn('Material not found or unsupported channel:', targetMaterialName);
      }
    });
  };
});

/////  cart ///// 
function getCart(){ try { return JSON.parse(localStorage.getItem('cartCars')) || []; } catch { return []; } }

function updateCartCount(){
  const count = getCart().length; 
  const el = document.getElementById('cartCount');
  if (!el) return;
  el.textContent = count;
  el.style.display = count > 0 ? 'inline-block' : 'none';
}

document.addEventListener('DOMContentLoaded', updateCartCount);


window.addEventListener('storage', (e) => {
  if (e.key === 'cartCars') updateCartCount();
});

document.querySelectorAll('.nav-item-dropdown').forEach(card => {
  card.addEventListener('click', () => {
    const modelId = card.dataset.id; 
    localStorage.setItem("modelId", modelId);
     window.location.href = "../pages/filter.php";
  });
});
