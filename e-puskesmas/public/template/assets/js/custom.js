/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

// menu active
var path = location.pathname.split('/')
var url = location.origin + '/' + path[1] + '/' + path[2] + '/' + path[3] + '/' + path[4] + '/' + path[5]

if (path[4] === 'home') {
    url = location.origin + '/' + path[1] + '/' + path[2] + '/' + path[3] + '/' + path[4]
}

$('ul.sidebar-menu li a').each(function() {
    if ($(this).attr('href').indexOf(url) !== -1) {
        $(this).parent().addClass('active').parent().parent('li').addClass('active')
    }
})

// datatables
$(document).ready( function () {
    $('#table1').DataTable();
} );

// modal confirmation
function submitDel(id) {
    $('#del-'+id).submit();
}

// image preview upload KTP
// $('select-img').selectric();
$.uploadPreview({
  input_field: "#image-upload",   // Default: .image-upload
  preview_box: "#image-preview",  // Default: .image-preview
  label_field: "#image-label",    // Default: .image-label
  label_default: "Choose File",   // Default: Choose File
  label_selected: "Change File",  // Default: Change File
  no_label: false,                // Default: false
  success_callback: null          // Default: null
});

// function previewImg() {
//     const ktp = document.querySelector('#image-upload');
//     // const ktpLabel = document.querySelector('.custom-file-label');
//     const imgPreview = document.querySelector('.image-preview');
    
//     // ktpLabel.textContent = ktp.files[0].name;
    
//     const fileKtp = new FileReader();
//     fileKtp.readAsDataURL(ktp.files[0]);
    
//     fileKtp.onload = function(e) {
//         imgPreview.src = e.target.result;
//     }
// }