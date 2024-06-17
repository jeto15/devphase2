<?php include '../header.php'; ?>
    <style>
        /* #video {
            width: 100%;
            max-width: 400px;
            margin-bottom: 10px;
        } */
        #canvas {
            display: none;
        }
    </style>
    <!-- <link href="patientpage.css" rel="stylesheet">  -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        </div> 
        <div  style="margin: auto;width: 47%; padding: 30px;" >
            <div class="">
                <video id="video" autoplay></video>
                <canvas id="canvas"></canvas>
            </div>
            <div style="text-align: center;">
                <button type="button" class="btn btn-danger" id="captureButton"><span data-feather="instagram"></span>  Capture</button>
            </div>
        </div>

    <input type="hidden" id="hd_recordid"  value="<?php echo $_GET['id'];?>" />
    <input type="hidden" id="hd_prescribe_id"  value="<?php echo  isset($_GET['presid'])? $_GET['presid']:''; ?>" />

    </main>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script>
         let recordId ='';
        $(function(){
            recordId  = $('#hd_recordid').val();
            let hdPrescribeId = $('#hd_prescribe_id').val();

            console.log('recordId', recordId);
        });

        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureButton = document.getElementById('captureButton');

        // Access the camera and stream the video
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                console.error('Error accessing the camera:', err);
            });

        // Capture and save the image
        captureButton.addEventListener('click', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convert canvas to base64 data URL
            const imageData = canvas.toDataURL('image/jpeg');
            // Send image data to the server for saving

            let PatientId = recordId;
            let CaptureType = 'avatar_pic';

         
            fetch('../_controller/capturepicture_controller.php', {
                method: 'POST',
                body: JSON.stringify({ image: imageData, patientid: PatientId, capturetype: CaptureType  }),
                headers: { 
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                  
                    alert('Image uploaded successfully.');

                    window.location.href = "../patientprofile/?id="+recordId;  
                    
                } else {
                    alert('Failed to upload image. Please contact your Administrator');
                    console.error('Failed to upload image.');
                }
            })
            .catch(err => { 
                alert('Failed to upload image. Please contact your Administrator. '+ err);
            });
        });
    </script>
  
 
<?php include '../footer.php'; ?> 