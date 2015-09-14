function fileSelected() {
  var count = document.getElementById('fileToUpload').files.length;
  for (var index = 0; index < count; index ++)
  {
    var file = document.getElementById('fileToUpload').files[index];
    var fileSize = 0;
    if (file.size > 1024 * 1024)
      fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
    else
      fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
  }
}

function uploadFile() {
  var fd = new FormData();
  var count = document.getElementById('fileToUpload').files.length;
  for (var index = 0; index < count; index ++)
  {
    var file = document.getElementById('fileToUpload').files[index];
    fd.append(index, file);
  }
  var xhr = new XMLHttpRequest();
  xhr.upload.addEventListener("progress", uploadProgress, false);
  xhr.addEventListener("load", uploadComplete, false);
  xhr.addEventListener("error", uploadFailed, false);
  xhr.addEventListener("abort", uploadCanceled, false);
  xhr.open("POST", "savetofile.php");
  xhr.send(fd);
}

function uploadProgress(evt) {
  if (evt.lengthComputable) {
    var percentComplete = Math.round(evt.loaded * 100 / evt.total);
    document.getElementById('progress').innerHTML = "uploading: "+percentComplete.toString() + '%<br/>Please Wait!';
  }
  else {
    document.getElementById('progress').innerHTML = 'Error';
  }
  if(percentComplete == 100)
  {
    document.getElementById('progress').innerHTML = "uploading: "+percentComplete.toString() + '%' + "<br/>Reloading...";
  }
}

function uploadComplete(evt) {
  /* This event is raised when the server send back a response */
  location.reload();
}

function uploadFailed(evt) {
  alert("Something went wrong! Please try again.");
}

function uploadCanceled(evt) {
  alert("Something went wrong! Please try again.");
}

function selectAndUpload() {
  document.getElementById('progress').innerHTML = "uploading... <br/>Please Wait!";
  document.getElementById('formTable').setAttribute("style", "display:none");
  fileSelected();
  uploadFile();
}