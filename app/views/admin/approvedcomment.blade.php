  <a href="{{url('admin/dashboard')}}" title="Go to Dahboard" class="operation pull-left">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <br>
  @if(count($noofcommment))
        <h4>Verified Comments</h4>
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th class="">Author</td>
              <th class="">Comment</td>
              <th class="">Comment On</td>
              <th class="">Date</td>
              <th class="">Operation</td>
            </tr>
            @foreach($noofcommment as $comment)
              <tr>
                <td>{{$comment->firstname.' '.$comment->lastname}}</td>
                <td>{{$comment->combody}}</td>
                <td>{{$comment->context}}</td>
                <td>{{$comment->postedon}}</td>
                <td>
                    <a href="#" data-id="{{$comment->commentid}}" title="Delete This Post" class="operation commentdelete"><span class="glyphicon glyphicon-remove-circle"></span></a>
                    <!-- <a href="#" data-id="{{$comment->commentid}}" title="Mark as Verified" class="operation"><span class="glyphicon glyphicon-ok-circle"></span></a> -->
                </td>
              </tr>
            @endforeach
          </table>
        </div>
        <?php echo $noofcommment->links(); ?>
        @else
          <span>No appproved Comments available</span>
        @endif