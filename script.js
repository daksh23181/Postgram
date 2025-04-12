document.addEventListener('DOMContentLoaded', function() {
    // Form toggle functionality
    const buttons = document.querySelectorAll('.btn[data-form]');
    const closeButtons = document.querySelectorAll('.close-btn');
    const overlay = document.getElementById('overlay');
    
    // Show form when button is clicked
    buttons.forEach(button => {
      button.addEventListener('click', function() {
        const formId = this.getAttribute('data-form');
        document.getElementById(formId).style.display = 'block';
        overlay.style.display = 'block';
      });
    });
    
    // Close form when close button is clicked
    closeButtons.forEach(button => {
      button.addEventListener('click', function() {
        const formContainer = this.closest('.form-container');
        formContainer.style.display = 'none';
        overlay.style.display = 'none';
      });
    });
    
    // Close form when overlay is clicked
    overlay.addEventListener('click', function() {
      document.querySelectorAll('.form-container').forEach(form => {
        form.style.display = 'none';
      });
      this.style.display = 'none';
    });
    
    
  });