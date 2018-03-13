
<!-- =========================== Pembahasan Soal (VIDEO) Modal =========================== -->
<div id="videoMotivasiModal" class='modal fade modal-center' role="dialog" tab-index='-1' aria-hidden='true' aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">        
        <div class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </div>
        <h4 class="modal-title" id="video_motivasi_label"><i class="glyphicon glyphicon-play-circle "></i> Video Motivasi</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          
          <div id="konten_video_motivasi">
            
            <input style="display: none;" id="connectStr" size = "56" type="text" placeholder="" value="http://localhost:1935/vod/mp4:test123.mp4/manifest.mpd"/>
            <button style="display: none;" id="connectObj" type="button" style="width:80px" onclick="JavaScript:connect()">Start</button>
            <label style="display: none;" id="statusStr" size = "100" type="text" placeholder="" value="">Disconnected</label>
            
            <div class="embed-responsive embed-responsive-16by9">
              <div id="player"></div>
              <video id="videoObj" x-webkit-airplay="allow" controls alt="Example File" width="630" height="354" autoplay></video>
            </div>

          </div>

        </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-default" data-dismiss="modal">Tutup</a>
      </div>
    </div>
  </div>
</div>