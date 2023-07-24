
<table>
    <thead>

        <tr>
            <th style="background-color:blue; color: white; font-weight: bold">Serial</th>
            <th style="background-color:blue; color: white; font-weight: bold">First Name</th>
            <th style="background-color:blue; color: white; font-weight: bold">Last Name</th>
            <th style="background-color:blue; color: white; font-weight: bold">Email</th>
            <th style="background-color:blue; color: white; font-weight: bold">Phone</th>
            <th style="background-color:blue; color: white; font-weight: bold">WhatsApp</th>
            <th style="background-color:blue; color: white; font-weight: bold">English Test</th>
            <th style="background-color:blue; color: white; font-weight: bold">Score Overall</th>
            <th style="background-color:blue; color: white; font-weight: bold">Low Score</th>
            <th style="background-color:blue; color: white; font-weight: bold">Country</th>
            <th style="background-color:blue; color: white; font-weight: bold">Highest Qualification</th>
            <th style="background-color:blue; color: white; font-weight: bold">Course Name</th>
            <th style="background-color:blue; color: white; font-weight: bold">Agent Name</th>
            <th style="background-color:blue; color: white; font-weight: bold">Documents</th>
        </tr>
    </thead>
    <tbody>
        @forelse($donors as $index=>$donor)
            <tr>
                <td style="text-align: center">{{ $index+1 }}</td>
                <td>{{ __($donor->lastname) }}</td>
                <td>{{ __($donor->lastname) }}</td>
                <td>{{ __($donor->email) }}</td>
                <td>{{ __($donor->phone) }}</td>
                <td>{{ __($donor->whatsapp) }}</td>
                <td>
                    @php
                    $engtestview = '';
                    $engtests = json_decode($donor->engtest);

                    foreach ($engtests as $engtest) {
                        $engtestview .= $engtest . ', ';
                    }
                    $engtestview = rtrim($engtestview, ', ');
                    echo $engtestview;
                @endphp
                </td>
                <td>{{ __($donor->score_overall) }}</td>
                <td>{{ __($donor->low_score) }}</td>
                <td>{{ __($donor->country) }}</td>
                <td>{{ __($donor->qualification) }}</td>
                <td>{{ __($donor->course) }}</td>
                <td>{{ $donor->agent->name ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
