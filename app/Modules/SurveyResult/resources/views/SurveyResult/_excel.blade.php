@if(isset($allSurveyResults) && !empty($allSurveyResults))
    <div class="table-responsive">
        <table  class="table table-striped table-bordered" id="table_id">
            <thead>
            <tr>
                <th colspan="9">Survey Result</th>
            </tr>
            <tr>
                <th>SL</th>
                <th>Organization</th>
                <th>Created</th>
                <th>Time</th>
                <th>Survey Name</th>
                <th>Particular</th>
                <th>Latitude</th>
                <th>Longitude</th>
                @if(Auth::user()->hasRole('ADMIN_OPERATOR') || Auth::user()->hasRole('ADMIN_REPORTER') || Auth::user()->hasRole('ADMINISTRATOR'))
                <th>User</th>
                @endif
            </tr>
            </thead>
            <tbody>
            <?php $i=1; ?>
            @foreach($allSurveyResults as $value)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$value->SurveyOrganization->name}}</td>
                    <td>{{$value->created_at->format('d-m-Y')}}</td>
                    <td>{{$value->created_at->format('h:i:s A')}}</td>
                    <td>{{$value->SurveyName->nameen}}</td>
                    <td>{{$value->SurveyItem->itemtexten}}</td>
                    <td>{{$value->latitude}}</td>
                    <td>{{$value->longitude}}</td>
                    @if(Auth::user()->hasRole('ADMIN_OPERATOR') || Auth::user()->hasRole('ADMIN_REPORTER') || Auth::user()->hasRole('ADMINISTRATOR'))
                    <td>{{$value->SurveyUser->name}}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endif