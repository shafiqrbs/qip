@if(isset($personData) && !empty($personData))
    <div class="table-responsive">
        <table  class="table table-striped table-bordered" id="table_id">
            <thead>
            <tr>
                <th colspan="5">Survey Calendar</th>
            </tr>
            <tr>
                <th colspan="5">{{$input['month'].' '.$input['year']}}</th>
            </tr>
            <tr>
                <th>SL</th>
                <th>Date</th>
                <th>Survey Name</th>
                <th>Organization Name</th>
                <th>Person</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; ?>
            @foreach($personData as $value)
                <?php
                $needle    = '-';
                $firstTwiDigit =  strstr($value->date, $needle, true);
                $firstTwiDigit = (int)$firstTwiDigit;
                ?>
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$value->date}}</td>
                    <td>{{$value->surveyNameEN }}</td>
                    <td>{{$value->organizationName}}</td>
                    <td>{{$value->person}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endif