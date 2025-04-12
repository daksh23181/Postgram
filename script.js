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
    
    // Form submission handling with PHP integration
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formId = this.id;
        const formData = new FormData(this);
        const endpoint = getEndpointForForm(formId);
        
        fetch(endpoint, {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Data inserted successfully!');
            this.reset();
            this.closest('.form-container').style.display = 'none';
            overlay.style.display = 'none';
          } else {
            alert('Error: ' + data.message);
          }
        })
        .catch(error => {
          alert('Error: ' + error.message);
        });
      });
    });
    
    function getEndpointForForm(formId) {
      const formEndpoints = {
        'userForm': 'insert_user.php',
        'loginForm': 'insert_login.php',
        'profileForm': 'insert_profile.php',
        'postForm': 'insert_post.php',
        'friendshipForm': 'insert_friendship.php',
        'commentForm': 'insert_comment.php',
        'likeForm': 'insert_like.php',
        'storyForm': 'insert_story.php'
      };
      return formEndpoints[formId] || '';
    }
  });