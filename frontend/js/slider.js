// Simple gallery slider/modal
document.addEventListener('DOMContentLoaded',function(){
  const gallery=document.getElementById('gallery');
  if(!gallery) return;
  gallery.addEventListener('click',e=>{
    const img=e.target.closest('img'); if(!img) return;
    const modal=document.createElement('div'); modal.className='modal';
    const large=document.createElement('img'); large.src=img.src.replace('w=900','w=1600');
    modal.appendChild(large);
    modal.addEventListener('click',()=>document.body.removeChild(modal));
    document.body.appendChild(modal);
  });
});
