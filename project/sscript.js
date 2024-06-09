const uploadbutton = document.getElementById('upload-button');
const form = document.getElementById('myform');
const videoInput = document.getElementById('videoInput');
const uploadButton = document.getElementById('uploadButton');
const videoGallery = document.getElementById('videoGallery');

uploadButton.addEventListener('click', uploadVideo);

function displayVideo(videoUrl) {
  const videoHTML = `
    <video width="400" controls>
      <source src="${videoUrl}" type="video/mp4">
    </video>
  `;
  videoGallery.innerHTML += videoHTML;
}

function uploadVideo() {
  const formData = new FormData();
  formData.append('video', videoInput.files[0]);
  fetch('upload.php', { method: 'POST', body: formData })
    .then(response => response.text())
    .then(videoUrl => displayVideo(videoUrl))
    .catch(error => console.error('Error uploading video:', error));
}

// Fetch random videos from database
fetch('connection.php')
  .then(response => response.json())
  .then(videos => {
    videos.forEach(video => displayVideo(video.url));
  })
  .catch(error => console.error('Error fetching videos:', error));
