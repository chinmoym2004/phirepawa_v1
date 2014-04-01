<a href="{{url('admin/dashboard')}}" title="Go to Dahboard" class="operation pull-left"><span class="glyphicon glyphicon-chevron-left"></span></a><br>
        @if(count($nooffaq))
        <h4>FAQ not yet verified</h4>
        
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th class="">Author</td>
              <th class="">Blog Title</td>
              <th class="">Posted On</td>
              <th class="">Operation</td>
            </tr>
            @foreach($nooffaq as $faq)
              <tr>
                <td>{{$faq->firstname.' '.$faq->lastname}}</td>
                <td>{{$faq->title}}</td>
                <td>{{$faq->postedon}}</td>
                <td>
                    <a href="#" data-id="{{$faq->faqid}}" title="Delete This Post" class="operation deletefaq"><span class="glyphicon glyphicon-remove-circle"></span></a>
                    <a href="#" data-id="{{$faq->faqid}}" title="Mark as Verified" class="operation verifyfaq"><span class="glyphicon glyphicon-ok-circle"></span></a>
                    <a href="{{url('admin/faqdisplay/'.$faq->faqid)}}" data-id="{{$faq->faqid}}" target="_blank" style="color:#fff">View</a>
                </td>
              </tr>
            @endforeach
          </table>
        </div>
        <?php echo $nooffaq->links(); ?>
        @else
          <span>No new FAQ  available</span>
        @endif