
  // Function to get query parameters
  function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
  }

  // Check for status and msg parameters
  const status = getQueryParam('status');
  const msg = getQueryParam('msg');

  if(status && msg) {
    // Show SweetAlert
    Swal.fire({
      icon: status === 'success' ? 'success' : 'error',
      title: status === 'success' ? 'Success!' : 'Oops...',
      text: decodeURIComponent(msg.replace(/\+/g, ' ')),
      confirmButtonColor: '#6366f1'
    });

    // Remove query parameters from URL after showing alert
    window.history.replaceState({}, document.title, window.location.pathname);
  }

