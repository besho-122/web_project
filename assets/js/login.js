
    const container = document.getElementById('container');
    const toggleText = document.getElementById('toggleText');

    function toggleForm() {
      container.classList.toggle('active');
      if (container.classList.contains('active')) {
        toggleText.textContent = "Don't have an account? Sign Up";
      } else {
        toggleText.textContent = "Already have an account? Sign In";
      }
    }