// preview img 
function previewImage(){
   const gambar = document.querySelector('.gambar');
   const previewGambar = document.querySelector('.imgPreview');

   const oFReader = new FileReader();

   oFReader.readAsDataURL(gambar.files[0]);

   oFReader.onload = function(oFREvent){
      previewGambar.src = oFREvent.target.result;
   };
}