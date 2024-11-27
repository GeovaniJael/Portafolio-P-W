const tabs = document.querySelectorAll('.tab');
      
        function handleTabClick(event) {
          tabs.forEach((tab) => tab.classList.remove('active'));
          event.target.classList.add('active');
        }

        tabs.forEach((tab) => {
          tab.addEventListener('click', handleTabClick);
        });

        document.getElementById('cerrar-btn').addEventListener('click', function() {
            window.location.href = 'index.html';
        });
        