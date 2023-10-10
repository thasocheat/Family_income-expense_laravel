
@include('frontpages.partials.header-link')


@include('frontpages.partials.navbar')
<!-- /navigation -->

<div class="modal applyLoanModal fade" id="applyLoan" tabindex="-1" aria-labelledby="applyLoanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h4 class="modal-title" id="exampleModalLabel">How much do you need?</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#!" method="post">
          <div class="row">
            <div class="col-lg-6 mb-4 pb-2">
              <div class="form-group">
                <label for="loan_amount" class="form-label">Amount</label>
                <input type="number" class="form-control shadow-none" id="loan_amount" placeholder="ex: 25000">
              </div>
            </div>
            <div class="col-lg-6 mb-4 pb-2">
              <div class="form-group">
                <label for="loan_how_long_for" class="form-label">How long for?</label>
                <input type="number" class="form-control shadow-none" id="loan_how_long_for" placeholder="ex: 12">
              </div>
            </div>
            <div class="col-lg-12 mb-4 pb-2">
              <div class="form-group">
                <label for="loan_repayment" class="form-label">Repayment</label>
                <input type="number" class="form-control shadow-none" id="loan_repayment" disabled>
              </div>
            </div>
            <div class="col-lg-6 mb-4 pb-2">
              <div class="form-group">
                <label for="loan_full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control shadow-none" id="loan_full_name">
              </div>
            </div>
            <div class="col-lg-6 mb-4 pb-2">
              <div class="form-group">
                <label for="loan_email_address" class="form-label">Email address</label>
                <input type="email" class="form-control shadow-none" id="loan_email_address">
              </div>
            </div>
            <div class="col-lg-12">
              <button type="submit" class="btn btn-primary w-100">Get Your Loan Now</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<section class="page-header bg-tertiary">
	<div class="container">
		<div class="row">
			<div class="col-8 mx-auto text-center">
				<h2 class="mb-3 text-capitalize text-primary">{{ trans('test.About') }}</h2>
				<ul class="list-inline breadcrumbs text-capitalize" style="font-weight:500">
					<li class="list-inline-item"><a href="index.html">{{ trans('test.Home') }}</a>
					</li>
					<li class="list-inline-item">/ &nbsp; <a href="about.html">{{ trans('test.About') }}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

</section>

<section class="section">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-7">
				<div class="section-title">
					<p class="text-primary text-uppercase fw-bold mb-3">{{ trans('test.About Wallet') }}</p>
					<h2 class="h1 mb-4">{{ trans('test.Business Loans') }} <br> {{ trans('test.For Daily Expenses') }}</h2>
					<div class="content pe-0 pe-lg-5">
                        <p> Manage all your money more secure and effective.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 mt-5 mt-lg-0">
				<img loading="lazy" decoding="async" src="{{asset("images/frontend")}}/about/about-11.jpg" alt="Business Loans &lt;br&gt; For Daily Expenses" class="rounded w-100">
			</div>
		</div>
	</div>
</section>

<section class="about-section section bg-tertiary position-relative overflow-hidden">
	<div class="container">
		<div class="row justify-content-around">
			<div class="col-lg-5">
				<div class="section-title">
					<p class="text-primary text-uppercase fw-bold mb-3"></p>
					<h2>{{ trans('test.Who We Are?') }}</h2>
				</div>

				<div class="content">We are students of the Regional Polytechnic Institude Techo Sen Siem Reap,
                    located in Siem Reap, Cambodia. This year, we are studying as third year students in the second semester,
                    which will end this October. </div>
			</div>
			<div class="col-lg-5">
				<div class="section-title">
					<p class="text-primary text-uppercase fw-bold mb-3"></p>
					<h2>{{ trans('test.What We Offer?') }}</h2>
				</div>
				<div class="content">
					<ul>
						{{-- <li>{{ trans('test.Once') }}</li>
						<li>{{ trans('test.Two') }}</li>
						<li>{{ trans('test.Tree') }}</li> --}}
                        <li>Frugal Living</li>
                        <li>Limit Credit Card Use</li>
                        <li>Calculate all Income</li>
                        <li>Keep Debt Ratio Healthy at 30%</li>
                        <li>Prepare Savings Funds, Emergency Funds, and Investments</li>
                        <li>Use Promos, Discounts, and Cashback When Shopping</li>
                        <li>Find Additional Income</li>
                        <li>Perform Periodic Evaluation</li>
                        <li>Record Expenditure and Income of Financial Posts</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

</section>

{{-- <section class="section-sm bg-primary-light">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-4 col-md-6 mb-5 mb-lg-0 text-center icon-box-item">
				<div class="icon icon-lg bg-transparent mb-4"><i class="fas fa-mouse-pointer text-primary"></i>
				</div>
				<h3>{{ trans('test.Quick Decision') }}</h3>
				<p class="px-lg-5">Begin the process when it is convenient for you</p>
			</div>
			<div class="col-lg-4 col-md-6 mb-5 mb-lg-0 text-center icon-box-item">
				<div class="icon icon-lg bg-transparent mb-4"><i class="fas fa-file-alt text-primary"></i>
				</div>
				<h3>{{ trans('test.Submit Your Info') }}</h3>
				<p class="px-lg-5">Begin the process when it is convenient for you</p>
			</div>
			<div class="col-lg-4 col-md-6 mb-5 mb-lg-0 text-center icon-box-item">
				<div class="icon icon-lg bg-transparent mb-4"><i class="fas fa-briefcase text-primary"></i>
				</div>
				<h3>{{ trans('test.Funds To You') }}</h3>
				<p class="px-lg-5">Begin the process when it is convenient for you</p>
			</div>
		</div>
	</div>
</section> --}}

<section class="section teams">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="section-title text-center">
					<p class="text-primary text-uppercase fw-bold mb-3">{{ trans('test.Our Members') }}</p>
					<h1>{{ trans('test.Member of Team') }}</h1>
					<p class="mb-0">{{ trans('test.We are members of group one') }}
				</div>
			</div>
		</div>
		<div class="row position-relative justify-content-center">

            @foreach($members as $m)
            <div class="col-xl-4 col-lg-4 col-md-6 mt-4">
				<div class="card bg-transparent border-0 text-center">
					<div class="card-img">
						<img loading="lazy" decoding="async" src="{{ asset('storage/uploads/members/'.$m->photo) }}" alt="Scarlet Pena" class="rounded w-100" width="300" height="332">
						<ul class="card-social list-inline">
							<li class="list-inline-item"><a class="facebook" target="_blank"  href="{{ $m->facebook }}"><i class="fab fa-facebook"></i></a>
							</li>
							<li class="list-inline-item"><a class="twitter" target="_blank"  href="{{ $m->instagram }}"><i class="fab fa-instagram"></i></a>
							</li>
							<li class="list-inline-item"><a class="instagram" target="_blank"  href="{{ $m->github }}"><i class="fab fa-github"></i></a>
							</li>
						</ul>
					</div>
					<div class="card-body">
						<h3>{{ $m->name }}</h3>
						<p>{{ $m->description }}</p>
					</div>
				</div>
			</div>
            @endforeach

		</div>
	</div>
</section>



@include("frontpages.partials.footer")

<!-- # JS Plugins -->
@include("frontpages.partials.footer-link")
