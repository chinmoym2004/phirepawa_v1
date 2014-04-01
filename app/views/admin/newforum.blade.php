<a href="{{url('admin/dashboard')}}" title="Go to Dahboard" class="operation pull-left"><span class="glyphicon glyphicon-chevron-left"></span></a><br>
        @if(count($noofforum))
        <h4>Forum not yet verified</h4>
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th class="">Author</td>
              <th class="">Forum Topics</td>
              <th class="">Posted On</td>
              <th class="">Operation</td>
            </tr>
            @foreach($noofforum as $forum)
              <tr>
                <td>{{$forum->firstname.' '.$forum->lastname}}</td>
                <td>{{$forum->title}}</td>
                <td>{{$forum->postedon}}</td>
                <td>
                    <a href="#" data-id="{{$forum->forumid}}" title="Delete This Post" class="operation deleteforum" ><span class="glyphicon glyphicon-remove-circle"></span></a>
                    <a href="#" data-id="{{$forum->forumid}}" title="Mark as Verified" class="operation verifyforum"><span class="glyphicon glyphicon-ok-circle"></span></a>
                    <a href="{{url('admin/forumdisplay/'.$forum->forumid)}}" data-id="{{$forum->forumid}}" target="_blank" style="color:#fff">View</a>
                </td>
              </tr>
            @endforeach
          </table>
        </div>
        <?php echo $noofforum->links(); ?>
        @else
          <span>No new Forum topics available</span>
        @endif