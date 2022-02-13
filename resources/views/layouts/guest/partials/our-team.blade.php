<section class="row breath">

    @foreach($team as $member)

        <div class="col-md-6">
            <div class="testblock">
                {{$member->description}}
                <hr>
                <b>Sigueme en mis redes.</b> <br>
                @if($member->links->facebook)
                    <a href="{{$member->links->facebook}}">
                        <i class="fab fa-facebook fa-2x"></i>
                    </a>
                @endif
                @if($member->links->instagram)
                <a href="{{$member->links->instagram}}">
                    <i class="fab fa-instagram fa-2x"></i>
                </a>
                @endif
                @if($member->links->tiktok)
                <a href="{{$member->links->tiktok}}">
                    <i class="fab fa-tiktok fa-2x"></i>
                </a>
                @endif
                @if($member->links->twitter)
                <a href="{{$member->links->twitter}}">
                    <i class="fab fa-twitter fa-2x"></i>
                </a>
                @endif
                @if($member->buy_me_a_coffee)
                    <hr>
                    <b>Invitame un café</b><br>
                    {!! $member->buy_me_a_coffee !!}
                @endif
            </div>

            <div class="clientblock">
                <img src="{{$member->image}}" alt=".">
                <p><strong>{{$member->name}}</strong> <br>
                    {{$member->position}}
                </p>
            </div>
        </div><! --/col-md-6 -->

    @endforeach

</section><! --/section -->
