var options = {
  filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
  filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
  filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
  filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
};
CKEDITOR.replace('content', options);
var lfm = function(id, type, options) {
  let button = document.getElementById(id);

  button.addEventListener('click', function () {
      var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
      var target_input = document.getElementById(button.getAttribute('data-input'));
      var target_preview = document.getElementById(button.getAttribute('data-preview'));

      window.open(route_prefix + '?type=' + type || 'file', 'FileManager', 'width=900,height=600');
      window.SetUrl = function (items) {
      var file_path = items.map(function (item) {
          return item.url;
      }).join(',');

      // set the value of the desired input to image url
      //target_input.value = file_path;
      target_input.value = target_input.value.length == 0 || !options.multiple ? file_path : (target_input.value + ',' + file_path);
      target_input.dispatchEvent(new Event('change'));

      // clear previous preview
      if(!options.multiple)
      {
        target_preview.innerHTML = ''; 
      }
      
      // set or change the preview image src
      items.forEach(function (item) {
        let wrapper = document.createElement('div');
        wrapper.className = 'pos-relative d-inline-block';

        let close = document.createElement('div');
        close.className = 'close';
        close.innerHTML = 'x';
        close.onclick = ()=>removeImage(close, item.url);
        
        
        let img = document.createElement('img')
        img.setAttribute('style', 'width: 100px')
        img.setAttribute('src', item.thumb_url);
        
        wrapper.appendChild(close);
        wrapper.appendChild(img);

        target_preview.appendChild(wrapper);
      });

      // trigger change event
      target_preview.dispatchEvent(new Event('change'));
      };
  });
};


const removeImage = (elem, path) =>
{
  const input = elem.closest('.gallery-js').querySelector('#thumbnail_gallery');
  input.value = input.value.split(',').filter(p => p != path).join(',');
  elem.parentNode.remove();
}



var route_prefix = "/laravel-filemanager";
lfm('lfm', 'image', {prefix: route_prefix, multiple: false});
lfm('lfm_gallery', 'image', {prefix: route_prefix, multiple: true});