$(document).ready(function () {
   // Mengubah kelas active berdasarkan URL saat ini
   $('.nav-link').each(function () {
      if (this.href === window.location.href) {
         $(this).addClass('active');
      }
   });

   // Menangani klik pada nav-link untuk menambahkan kelas active
   $('.nav-link').click(function () {
      $('.nav-link').removeClass('active');
      $(this).addClass('active');
   });
});
