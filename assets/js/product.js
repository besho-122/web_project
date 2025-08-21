
localStorage.removeItem('modelId');
localStorage.removeItem('modelName');
localStorage.removeItem('condition');

document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', function () {
    document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
    this.classList.add('active');
  });
});
document.addEventListener('DOMContentLoaded', () => {


  document.querySelectorAll('.productCards a').forEach((link) => {
    link.addEventListener('click', (e) => {
      const card = link.querySelector('.card');
      const id   = card?.dataset.id;
      const name = card?.querySelector('.card-title')?.textContent.trim();
      if (id)   localStorage.setItem('modelId', id);
      if (name) localStorage.setItem('modelName', name);
      e.preventDefault();
      window.location.href = link.href; 
    });
  });
});

function showFeedback() {
      document.getElementById('feedback').style.display = 'block';
    }

 // Select all cards
document.querySelectorAll('.card').forEach(card => {
  card.addEventListener('click', () => {
    const modelId = card.dataset.id; 
    localStorage.setItem("modelId", modelId);
     window.location.href = "../pages/filter.php";
  });
});




// used button  //


document.querySelectorAll('.usedcars').forEach(card => {
  card.addEventListener('click', () => {
    localStorage.setItem("condition", "used");
     window.location.href = "../pages/filter.php";
  });
});

// new button //
document.querySelectorAll('.newcars').forEach(card => {
  card.addEventListener('click', () => {
    localStorage.setItem("condition", "new");
     window.location.href = "../pages/filter.php";
  });
});

// pre owned button //
document.querySelectorAll('.preownedcars').forEach(card => {
  card.addEventListener('click', () => {
    localStorage.setItem("condition", "preowned");
     window.location.href = "../pages/filter.php";
  });
});

//////////////////// doop down //////////////
//////////////////// doop down //////////////
document.querySelectorAll('.nav-item-dropdown').forEach(card => {
  card.addEventListener('click', () => {
    const modelId = card.dataset.id; 
    localStorage.setItem("modelId", modelId);
     window.location.href = "../pages/filter.php";
  });
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


//Fade In
function observeAndAddClass(selector, className) {
  const element = document.querySelector(selector);

  if (!element) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        element.classList.add(className);
        observer.unobserve(element);
      }
    });
  }, { threshold: 0.2 });

  observer.observe(element);
}

observeAndAddClass('.homePageFourSection', 'show');
observeAndAddClass('.swiper1', 'show');



const input = document.getElementById('searchInput');
let matches = [];
let currentIndex = -1;

// Find and highlight matches without breaking layout
function highlightMatches(text) {
    removeHighlights();
    matches = [];
    currentIndex = -1;
    if (!text) return;

    const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null);
    while (walker.nextNode()) {
        const node = walker.currentNode;
        const regex = new RegExp(text, 'gi');
        let match;
        while ((match = regex.exec(node.textContent)) !== null) {
            matches.push({ node, start: match.index, end: match.index + match[0].length });
        }
    }

    matches.forEach((m, i) => {
        const span = document.createElement('span');
        span.textContent = m.node.textContent.slice(m.start, m.end);
        span.classList.add('highlight');
        const parent = m.node.parentNode;

        const after = m.node.splitText(m.start);
        after.textContent = after.textContent.slice(m.end - m.start);
        parent.insertBefore(span, after);
        m.node = span; 
    });

    if (matches.length > 0) {
        currentIndex = 0;
        scrollToCurrent();
    }
}

// Remove all highlights
function removeHighlights() {
    document.querySelectorAll('.highlight2').forEach(span => {
        const parent = span.parentNode;
        parent.replaceChild(document.createTextNode(span.textContent), span);
        parent.normalize();
    });
}

// Scroll to the current match
function scrollToCurrent() {
    document.querySelectorAll('.current').forEach(c => c.classList.remove('current'));
    if (currentIndex >= 0 && matches[currentIndex]) {
        matches[currentIndex].node.classList.add('current');
        matches[currentIndex].node.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

// Navigate with arrows
input.addEventListener('keydown', e => {
    if (!matches.length) return;
    if (e.key === 'ArrowDown' || e.key === 'Enter') {
        currentIndex = (currentIndex + 1) % matches.length;
        scrollToCurrent();
        e.preventDefault();
    } else if (e.key === 'ArrowUp') {
        currentIndex = (currentIndex - 1 + matches.length) % matches.length;
        scrollToCurrent();
        e.preventDefault();
    }
});

// Listen to typing
input.addEventListener('input', () => {
    highlightMatches(input.value);
});
