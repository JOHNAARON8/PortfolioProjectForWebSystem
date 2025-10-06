  function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
  }

  const status = getQueryParam('status');
  const msg = getQueryParam('msg');

  if(status && msg) {
    Swal.fire({
      icon: status === 'success' ? 'success' : 'error',
      title: status === 'success' ? 'Success!' : 'Oops...',
      text: decodeURIComponent(msg.replace(/\+/g, ' ')),
      confirmButtonColor: '#6366f1'
    });

    window.history.replaceState({}, document.title, window.location.pathname);
  }

