<div class="tab-pane fade" id="433b-navs-income-expenses" role="tabpanel" style="text-align:left;">
    <!-- <h4 class="card-title">Personal & Emp</h4> -->
    <div class="card-body pt-3">
        <form>
			<!-- <h6 class="pt-0">1. Account Details</h6> -->
			<div class="row g-6">
				<div class="col-md-12 item-433b-income-expense">
						@php
							$monthlyFinancial = isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0] : '';

							$total_income = @$monthlyFinancial->gross_receipts + @$monthlyFinancial->gross_rental_income + @$monthlyFinancial->interest + @$monthlyFinancial->dividends + @$monthlyFinancial->cash_receipts;

							$total_expense = @$monthlyFinancial->materials_purchased + @$monthlyFinancial->inventory_purchased + @$monthlyFinancial->wages_salaries + @$monthlyFinancial->rent + @$monthlyFinancial->supplies + @$monthlyFinancial->utilities + @$monthlyFinancial->vehicle_gas_oil + @$monthlyFinancial->repairs_maintenance + @$monthlyFinancial->insurance + @$monthlyFinancial->current_taxes;
						@endphp
						<input type="hidden" name="income_expense_id" id="income_expense_id" value="{{@$monthlyFinancial->id}}">
					
					    <!-- Método Contable -->
					    <div class="mb-3">
					        <label class="form-label fw-bold">Accounting Method Used</label>
					        <div class="form-check form-check-inline">
					            <input class="form-check-input input-433b-income-expense-check" type="radio" id="accounting_method" name="accounting_method" value="cash" {{ (@$monthlyFinancial->accounting_method == 'cash') ? 'checked' : '' }}>
					            <label class="form-check-label">Cash</label>
					        </div>
					        <div class="form-check form-check-inline">
					            <input class="form-check-input input-433b-income-expense-check" type="radio" id="accounting_method" name="accounting_method" value="accrual" {{ (@$monthlyFinancial->accounting_method == 'accrual') ? 'checked' : '' }}>
					            <label class="form-check-label">Accrual</label>
					        </div>
					    </div>

					    <!-- Período de Ingresos/Gastos -->
					    <div class="mb-3 row">
					        <label class="col-sm-3 col-form-label">Income/Expense Period From</label>
					        <div class="col-sm-3">
					            <input type="date" class="form-control input-433b-income-expense-blur" name="period_start" id="period_start" value="{{ @$monthlyFinancial->period_start }}">
					        </div>
					        <label class="col-sm-1 col-form-label text-center">To</label>
					        <div class="col-sm-3">
					            <input type="date" class="form-control input-433b-income-expense-blur" name="period_end" id="period_end" value="{{ @$monthlyFinancial->period_end }}">
					        </div>
					    </div>

					    <div class="row">
					        <!-- Ingresos -->
					        <div class="col-md-6">
					            <h5 class="fw-bold">Total Monthly Business Income</h5>
					            <div class="mb-2">
					                <label class="form-label">Gross Receipts</label>
					                <input type="number" class="form-control input-433b-income-expense-blur income" name="gross_receipts" id="gross_receipts" value="{{ @$monthlyFinancial->gross_receipts }}">
					            </div>
					            <div class="mb-2">
					                <label class="form-label">Gross Rental Income</label>
					                <input type="number" class="form-control input-433b-income-expense-blur income" name="gross_rental_income" id="gross_rental_income" value="{{ @$monthlyFinancial->gross_rental_income }}">
					            </div>
					            <div class="mb-2">
					                <label class="form-label">Interest</label>
					                <input type="number" class="form-control input-433b-income-expense-blur income" name="interest" id="interest" value="{{ @$monthlyFinancial->interest }}">
					            </div>
					            <div class="mb-2">
					                <label class="form-label">Dividends</label>
					                <input type="number" class="form-control input-433b-income-expense-blur income" name="dividends" id="dividends" value="{{ @$monthlyFinancial->dividends }}">
					            </div>
					            <div class="mb-2">
					                <label class="form-label">Cash Receipts</label>
					                <input type="number" class="form-control input-433b-income-expense-blur income" name="cash_receipts" id="cash_receipts" value="{{ @$monthlyFinancial->cash_receipts }}">
					            </div>
					            <h6 class="fw-bold">TOTAL: <span id="total_income">{{number_format($total_income,2)}}</span></h6>
					        </div>

					        <!-- Gastos -->
					        <div class="col-md-6">
					            <h5 class="fw-bold">Total Monthly Business Expenses</h5>
					            <div class="mb-2">
					                <label class="form-label">Materials Purchased</label>
					                <input type="number" class="form-control expense input-433b-income-expense-blur" name="materials_purchased" id="materials_purchased" value="{{@$monthlyFinancial->materials_purchased}}">
					            </div>
					            <div class="mb-2">
					                <label class="form-label">Inventory Purchased</label>
					                <input type="number" class="form-control expense input-433b-income-expense-blur" name="inventory_purchased" id="inventory_purchased" value="{{@$monthlyFinancial->inventory_purchased}}">
					            </div>
					            <div class="mb-2">
					                <label class="form-label">Gross Wages & Salaries</label>
					                <input type="number" class="form-control expense input-433b-income-expense-blur" name="wages_salaries" id="wages_salaries" value="{{@$monthlyFinancial->wages_salaries}}">
					            </div>
					            <div class="mb-2">
					                <label class="form-label">Rent</label>
					                <input type="number" class="form-control expense input-433b-income-expense-blur" name="rent" id="rent" value="{{@$monthlyFinancial->rent}}">
					            </div>
					            <div class="mb-2">
					                <label class="form-label">Supplies</label>
					                <input type="number" class="form-control expense input-433b-income-expense-blur" name="supplies" id="supplies" value="{{@$monthlyFinancial->supplies}}">
					            </div>
					            <div class="mb-2">
					                <label class="form-label">Utilities/Telephone</label>
					                <input type="number" class="form-control expense input-433b-income-expense-blur" name="utilities" id="utilities" value="{{@$monthlyFinancial->utilities}}">
					            </div>
					            <div class="mb-2">
					                <label class="form-label">Vehicle Gasoline/Oil</label>
					                <input type="number" class="form-control expense input-433b-income-expense-blur" name="vehicle_gas_oil" id="vehicle_gas_oil" value="{{@$monthlyFinancial->vehicle_gas_oil}}">
					            </div>
					            <div class="mb-2">
					                <label class="form-label">Repairs & Maintenance</label>
					                <input type="number" class="form-control expense input-433b-income-expense-blur" name="repairs_maintenance" id="repairs_maintenance" value="{{@$monthlyFinancial->repairs_maintenance}}">
					            </div>
					            <div class="mb-2">
					                <label class="form-label">Insurance</label>
					                <input type="number" class="form-control expense input-433b-income-expense-blur" name="insurance" id="insurance" value="{{@$monthlyFinancial->insurance}}">
					            </div>
					            <div class="mb-2">
					                <label class="form-label">Current Taxes</label>
					                <input type="number" class="form-control expense input-433b-income-expense-blur" name="current_taxes" id="current_taxes" value="{{@$monthlyFinancial->current_taxes}}">
					            </div>
					            <h6 class="fw-bold">TOTAL: <span id="total_expenses">{{ number_format($total_expense,2) }}</span></h6>
					        </div>
					    </div>

					    <!-- Ingreso Neto -->
					    <h4 class="mt-3 fw-bold">Net business income: <span id="net_income">${{ number_format(  ($total_income - $total_expense),2)}}</span></h4>
					

					<script>
					    function calculateTotals() {
					        let totalIncome = 0;
					        let totalExpenses = 0;

					        document.querySelectorAll(".income").forEach(input => {
					            totalIncome += Number(input.value) || 0;
					        });

					        document.querySelectorAll(".expense").forEach(input => {
					            totalExpenses += Number(input.value) || 0;
					        });

					        document.getElementById("total_income").innerText = totalIncome.toLocaleString();
					        document.getElementById("total_expenses").innerText = totalExpenses.toLocaleString();
					        document.getElementById("net_income").innerText = `$${(totalIncome - totalExpenses).toLocaleString()}`;
					    }

					    document.addEventListener("DOMContentLoaded", function () {
					        document.querySelectorAll(".income, .expense").forEach(input => {
					            input.addEventListener("input", calculateTotals);
					        });
					    });
					</script>
									










				</div>
			</div>
		</form>
	</div>
</div>