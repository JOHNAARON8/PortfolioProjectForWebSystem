<script>
    let lastKnownUpdate = "<?php echo $latestUpdate; ?>";

    function showErrorMessage(message) {
        let existing = document.getElementById('db-error-message');
        if (!existing) {
            const div = document.createElement('div');
            div.id = 'db-error-message';
            div.textContent = message;
            div.style.position = 'fixed';
            div.style.bottom = '20px';
            div.style.left = '50%';
            div.style.transform = 'translateX(-50%)';
            div.style.backgroundColor = 'red';
            div.style.color = 'white';
            div.style.padding = '10px 20px';
            div.style.borderRadius = '5px';
            div.style.zIndex = '9999';
            document.body.appendChild(div);
            setTimeout(() => div.remove(), 5000);
        }
    }
    
    setInterval(() => {
        fetch(window.location.href, { method: 'GET' }) 
            .then(response => response.text())
            .then(html => {
                const match = html.match(/let lastKnownUpdate = "(.+?)";/);
                if (match && match[1] !== lastKnownUpdate) {
                    console.log('Database changed, reloading page...');
                    location.reload();
                }
            })
            .catch(err => {
                console.error('Error checking DB changes:', err);
                showErrorMessage('Error checking DB changes: ' + err.message);
            });
    }, 1000); 
</script>