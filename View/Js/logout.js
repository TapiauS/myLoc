const disconnectbutton=document.querySelector('#disconnect');
disconnectbutton.addEventListener('click', ()=>{
    if (confirm('Voulez vous vraiment vous deconnecter')) {
      window.location.href = 'index.php?target=logout';
    }
  });