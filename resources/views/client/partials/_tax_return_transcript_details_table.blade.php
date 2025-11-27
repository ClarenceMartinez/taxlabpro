{{-- resources/views/client/partials/_tax_return_transcript_details_table.blade.php --}}
{{-- (Contenido de tu _transcript_details_table.blade.php original) --}}
@php
    $details = [
        'SSN' => $transcript['ssn'] ?? 'N/A',
        'Spouse SSN' => $transcript['spouse_ssn'] ?? 'N/A',
        'Names on Return' => $transcript['names_on_return'] ?? 'N/A',
        'Filing Status' => $transcript['filing_status'] ?? 'N/A',
        'Total Income' => isset($transcript['total_income']) ? '$' . number_format($transcript['total_income'], 2) : 'N/A',
        'Adjusted Gross Income' => isset($transcript['adjusted_gross_income']) ? '$' . number_format($transcript['adjusted_gross_income'], 2) : 'N/A',
        'Taxable Income' => isset($transcript['taxable_income']) ? '$' . number_format($transcript['taxable_income'], 2) : 'N/A',
        'Total Tax' => isset($transcript['total_tax']) ? '$' . number_format($transcript['total_tax'], 2) : 'N/A',
        'Total Payments' => isset($transcript['total_payments']) ? '$' . number_format($transcript['total_payments'], 2) : 'N/A',
        'Balance Due / Overpayment' => isset($transcript['balance_due_or_overpayment'])
            ? ($transcript['balance_due_or_overpayment'] >= 0
                ? '<span class="value-owed">$' . number_format($transcript['balance_due_or_overpayment'], 2) . '</span>'
                : '<span class="value-overpayment">$' . number_format(abs($transcript['balance_due_or_overpayment']), 2) . ' (Overpayment)</span>')
            : 'N/A',
    ];
@endphp

<div class="table-responsive">
    <table class="table table-sm table-bordered table-hover table-compact-transcripts">
        <tbody>
            @foreach($details as $key => $value)
             @if($value !== 'N/A' && $value !== '$0.00') {{-- Simple condition to hide N/A or $0.00 --}}
                <tr>
                    <th scope="row" style="width: 40%;" data-label="{{ $key }}">{{ $key }}</th>
                    <td data-label="{{ $key }}">{!! $value !!}</td>
                </tr>
             @endif
            @endforeach
        </tbody>
    </table>
</div>