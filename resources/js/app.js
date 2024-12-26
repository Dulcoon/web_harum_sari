import './bootstrap';
import 'flowbite';
import $ from 'jquery';
window.$ = window.jQuery = $;


import Alpine from 'alpinejs';
import mask from '@alpinejs/mask'

window.Alpine = Alpine;

Alpine.plugin(mask)
Alpine.start();


jQuery(document).ready(function($) {
 $(document).ready(function($) {
  $(document).on('click', '.add-to-cart', function (e) {
      e.preventDefault();

      const productId = $(this).data('id');
      const baseUrl = $('meta[name="base-url"]').attr('content');

      $.ajax({
          url: `/cart/add`, // Rute yang sesuai
          method: "POST",
          data: {
              _token: $('meta[name="csrf-token"]').attr('content'),
              product_id: productId,
              quantity: 1,
          },
          success: function (response) {
              alert(response.message);
          },
          error: function (xhr) {
              alert('Something went wrong!');
          }
      });
  });
});

});

