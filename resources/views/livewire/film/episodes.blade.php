<div class="col-12 col-xl-6">
    <div id="iframe-container">
        <iframe id="embed-player" src="{{$vietsub}}" width="100%" height="380" allowfullscreen></iframe>
    </div>
    <div class="" style="margin-top: 10px;">
        @if($thuyetminh == null)
        <div></div>
        @else
        <button id="btn-vietsub" class="btn btn-secondary">Vietsub</button>
        <button id="btn-thuyetminh" class="btn btn-secondary">Thuyết minh</button>
        @endif
    </div>
    @if($episodes[0]['total_episodes']!=1)
    <div class="" style="margin-top: 10px;">
        @foreach($episodes as $episode)
        <button class="btn btn-secondary mb-1" wire:click="loadStream('{{ $episode['uuid'] }}')" {{
            $episode['uuid']==$activeEpisode ? 'disabled' : '' }}>
            Tập {{ $episode['episode'] }}
        </button>
        @endforeach
    </div>
    @else
    <div></div>
    @endif
    <script>
        const linkVietsub = "{{$vietsub}}";
        const linkThuyetminh = "{{$thuyetminh}}";

        const btnVietsub = document.getElementById('btn-vietsub');
        const btnThuyetminh = document.getElementById('btn-thuyetminh');
        const iframe = document.getElementById('embed-player');

        btnVietsub.disabled = true;

        btnVietsub.addEventListener('click', function () {
            iframe.src = linkVietsub;
            btnVietsub.disabled = true;
            btnThuyetminh.disabled = false;
        });

        btnThuyetminh.addEventListener('click', function () {
            iframe.src = linkThuyetminh;
            btnThuyetminh.disabled = true;
            btnVietsub.disabled = false;
        });
    </script>
</div>