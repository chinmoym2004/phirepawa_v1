<a href="{{url('admin/dashboard')}}" title="Go to Dahboard" class="operation pull-left"><span class="glyphicon glyphicon-chevron-left"></span></a><br>
        @if(count($noofcomments))
        <h4>Comments not yet verified</h4>
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th class="">Author</td>
              <th class="">Blog Title</td>
              <th class="">Context</td>
              <th class="">Posted On</td>
              <th class="">Operation</td>
            </tr>
            @foreach($noofcomments as $noofcomments1)
              <tr>
                <td>{{$noofcomments1->firstname.' '.$noofcomments1->lastname}}</td>
                <td>{{$noofcomments1->combody}}</td>
                <td>{{$noofcomments1->context}}</td>
                <td>{{$noofcomments1->postedon}}</td>
                <td>
                    <a href="#" data-id="{{$noofcomments1->commentid}}" title="Delete This Post" class="operation commentdelete"><span class="glyphicon glyphicon-remove-circle"></span></a>
                    <a href="#" data-id="{{$noofcomments1->commentid}}" title="Mark as Verified" class="operation commentverify"><span class="glyphicon glyphicon-ok-circle"></span></a>
                </td>
              </tr>
            @endforeach
          </table>
        </div>
        <?php echo $noofcomments->links(); ?>
        @else
          <span>No new FAQ  available</span>
        @endif