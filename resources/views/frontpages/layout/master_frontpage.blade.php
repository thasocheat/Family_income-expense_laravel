@include('frontpages.partials.header-link')



<!-- navigation -->
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

<section class="banner bg-tertiary position-relative overflow-hidden">
    <div class="container">
        <div class="row align-items-center justify-content-center">
        <div class="col-lg-12 mb-5 mb-lg-0">
            <div class="block text-center text-lg-start pe-0 pe-xl-5">
            <h1 style="font-weight: 500" class="text-center mb-4"> <span class="text-success">{{trans('test.SW')}}</span><br/> {{trans('test.TM')}} <span class="text-success">{{trans('test.PF')}}</span></h1>
            <div class="text-center">

                    <a href="{{ route('login') }}" class="btn btn-outline-primary">{{ trans('test.Try on browser') }}</a>

                    <a href="{{ route('register') }}" class="btn btn-primary ms-2 ms-lg-3">{{ trans('test.Download for free') }}</a>
            </div>
            </div>


        </div>
        </div>

    <br><br><br/>
    <div class="row m-5">

        <div class="col-lg-3 col-md-6 service-item" style="background-color: rgba(208, 255, 214, 0.227); border-radius:5px">
        {{-- <a class="text-black" href="#"> --}}
            <div class="block" > <span style="margin-left:30%;" class="colored-box text-center h3 mb-4">

                <img  class="align-center" src="/frontend/images/1.svg" />

            </span>
            <h3 class="mb-3 service-title  fw-normal fs-5">{{ trans('test.100% Secure data') }}</h3>
            </div>
        {{-- </a> --}}
        </div>

        <div class="col-lg-3 col-md-6 service-item" style="background-color: rgba(208, 255, 214, 0.227); border-radius:5px">
            {{-- <a class="text-black" href="#"> --}}
            <div class="block"> <span style="margin-left:30%;" class="colored-box text-center h3 mb-4">

                <img src="/frontend/images/2.svg" />

                </span>
                <h3 class="mb-3 service-title  fw-normal fs-5 text-center">{{ trans('test.1 Million+ users') }}</h3>
            </div>
            {{-- </a> --}}
        </div>

        <div class="col-lg-3 col-md-6 service-item" style="background-color: rgba(208, 255, 214, 0.227); border-radius:5px">
            {{-- <a class="text-black" href="#"> --}}
            <div class="block"> <span style="margin-left:30%;" class="colored-box text-center h3 mb-4">

                <img src="/frontend/images/3.svg" />

                </span>
                <h3 class="mb-3 service-title  fw-normal fs-5 text-center">{{ trans('test.100K+ 5-star Reviews') }}</h3>
            </div>
            {{-- </a> --}}
        </div>

        <div class="col-lg-3 col-md-6 service-item" style="background-color: rgba(208, 255, 214, 0.227); border-radius:5px">
            {{-- <a class="text-black" href="#"> --}}
            <div class="block"> <span style="margin-left:30%;" class="colored-box text-center h3 mb-4">

                <img src="/frontend/images/4.svg" />

                </span>
                <h3 class="mb-3 service-title fw-normal fs-5 text-center">{{ trans('test.App of the day') }}</h3>
            </div>
            {{-- </a> --}}
        </div>

    </div>
</section>


<section style="margin-top:-100px" class="about-section section bg-tertiary position-relative overflow-hidden">

  <div class="container" style="margin-bottom:100px">
    <div class="row align-items-center" style="justify-content: center;">
      <div class="col-lg-5 ">
        <div class="section-title">

            <div class="col-lg-10 col-md-6 pt-1">
                <div class="shadow rounded bg-white p-4 mt-4" style="font-seze:12px">
                  {{-- <div class="d-flex justify-content-between">
                    <div class="bg-white">{{ trans('test.LAST MONTH') }}</div>
                    <div class="bg-white text-dark fw-bold"></div>{{ trans('test.THIS MONTH') }}
                    <div class="bg-white"></div>{{ trans('test.FUTURE') }}

                  </div><hr> --}}

                  <div class="d-flex justify-content-between">
                    <div class="bg-white">
                        <img src="/frontend/images/Transaction.png" />
                    </div>
                  </div><br>


                  {{-- <div class="d-flex justify-content-between">
                    <div class="bg-white">
                        <img src="#" width="24px" height="24px" />
                        <label for="">Text</label>
                    </div>
                    <div class="bg-white">50,000</div>
                  </div><br>

                  <div class="d-flex justify-content-between">
                    <div class="bg-white">
                        <img src="#" width="24px" height="24px" />
                        <label for="">Text</label>
                    </div>
                    <div class="bg-white">50,000</div>
                  </div><br>

                  <div class="d-flex justify-content-between">
                    <div class="bg-white">
                        <img src="#" width="24px" height="24px" />
                        <label for="">Text</label>
                    </div>
                    <div class="bg-white">50,000</div>
                  </div><br> --}}


                </div>
            </div>

        </div>
      </div>

      <div class="col-lg-5 text-center text-lg-end">
        <div class="section-title">
            <h1 style="text-align:left" class="fw-normal">{{ trans('test.Simple money tracker') }}</h1>
            <p class="lead mb-0 mt-4">
              <p style="text-align:left">{{ trans('test.It takes seconds to record daily transactions. Put them into clear and visualized categories such as Expense: Food, Shopping or Income: Salary, Gift.') }}</p>
          </div>
      </div>
    </div>
  </div>


  <div class="container" style="margin-bottom:100px">
    <div class="row align-items-center" style="justify-content: center;">
        <div class="col-lg-5 text-center text-lg-end">
            <div class="section-title">
                <h1 style="text-align:left" class="fw-normal">{{ trans('test.Painless budgeting') }}</h1>
                <p class="lead mb-0 mt-4">
                  <p style="text-align:left">It takes seconds to record daily transactions. Put them into clear and visualized categories such as Expense: Food, Shopping or Income: Salary, Gift.</p>
              </div>
        </div>

      <div class="col-lg-5 ">
        <div class="section-title">

            <div class="col-lg-10 col-md-6 pt-1">
                <div class="shadow rounded bg-white p-4 mt-4" style="font-seze:12px">

                  {{-- <div class="d-flex justify-content-between">
                    <div class="bg-white">
                        <img src="#" width="24px" height="24px" />
                        <label for="">Text</label>
                    </div>
                    <div class="bg-white">50,000</div>
                  </div><br> --}}

                  <div class="d-flex justify-content-between">
                    <div class="bg-white">
                        <img src="/frontend/images/budget.png" />
                    </div>
                  </div><br>



                </div>
              </div>

        </div>
      </div>

    </div>
  </div>


  <div class="container" style="margin-bottom:100px">
    <div class="row align-items-center" style="justify-content: center;">
      <div class="col-lg-5 ">
        <div class="section-title">

            <div class="col-lg-10 col-md-6 pt-1">
                <div class="shadow rounded bg-white p-4 mt-4" style="font-seze:12px">

                  {{-- <table class="table table-borderless text-dark">
                    <thead>
                      <tr class="text-center">
                        <th>{{ trans('test.Income') }}</th>
                        <th>{{ trans('test.Expense') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="text-center" style="font-size: 20px;">
                        <td class="text-primary">$ 120,50.00</td>
                        <td class="text-danger">$ 2000.00</td>
                      </tr>
                      <tr class="text-center">
                        <td class="text-primary">
                            <img hight="200px"; width="65px";  src="/frontend/images/Layer1.png" alt="income">
                        </td>
                        <td class="text-danger">
                            <img hight="200px"; width="100px";  src="/frontend/images/Layer2.png" alt="expense">
                        </td>
                      </tr>

                    </tbody>
                  </table> --}}

                  <div class="d-flex justify-content-between">
                    <div class="bg-white">
                        <img src="/frontend/images/report.png" />
                    </div>
                  </div><br>


                </div>
            </div>
        </div>
      </div>

      <div class="col-lg-5 text-center text-lg-end">
        <div class="section-title">
            <h1 style="text-align:left" class="fw-normal">{{ trans('test.The whole picture in one place') }}</h1>
            <p class="lead mb-0 mt-4">
              <p style="text-align:left">One report to give a clear view on your spending patterns. Understand where your money comes and goes with easy-to-read graphs.</p>
            </div>
      </div>
    </div>
  </div>

</section>

<section style="margin-top:-200px" class="homepage_tab position-relative">
  <div class="section container">
    <div class="row justify-content-center">
      <div class="col-lg-8 mb-4">
        <div class="section-title text-center">
          <h1 class="text-primary text-uppercase fw-bold mb-3">{{ trans('test.Painless budgeting') }}</h1>
          <h1>{{ trans('test.Get Know The Basics Simple Pricing And Payments') }}</h1>
        </div>
      </div>
      <div class="col-lg-10">
        <ul class="payment_info_tab nav nav-pills justify-content-center mb-4" id="pills-tab" role="tablist">
          <li class="nav-item m-2" role="presentation"> <a
              class="nav-link btn btn-outline-primary effect-none text-dark active" id="pills-how-much-can-i-recive-tab"
              data-bs-toggle="pill" href="#pills-how-much-can-i-recive" role="tab"
              aria-controls="pills-how-much-can-i-recive" aria-selected="true">{{ trans('test.How Much Can I Recive?') }}</a>
          </li>
          <li class="nav-item m-2" role="presentation"> <a
              class="nav-link btn btn-outline-primary effect-none text-dark " id="pills-how-much-does-it-costs-tab"
              data-bs-toggle="pill" href="#pills-how-much-does-it-costs" role="tab"
              aria-controls="pills-how-much-does-it-costs" aria-selected="true">{{ trans('test.How Much Does It Costs?') }}</a>
          </li>
          <li class="nav-item m-2" role="presentation"> <a
              class="nav-link btn btn-outline-primary effect-none text-dark " id="pills-how-do-i-repay-tab"
              data-bs-toggle="pill" href="#pills-how-do-i-repay" role="tab" aria-controls="pills-how-do-i-repay"
              aria-selected="true">{{ trans('test.How Do I Repay?') }}</a>
          </li>
        </ul>
        <div class="rounded shadow bg-white p-5 tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-how-much-can-i-recive" role="tabpanel"
            aria-labelledby="pills-how-much-can-i-recive-tab">
            <div class="row align-items-center">
              <div class="col-md-6 order-1 order-md-0">
                <div class="content-block">
                  <h3 class="mb-4">How Much Can I Recive?</h3>
                  <div class="content">
                    <p>You can get a lot of advantages. It also allows you to know your income and expenses every day.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 order-0 order-md-1 mb-5 mt-md-0">
                <div class="image-block text-center">
                  <img loading="lazy" decoding="async"
                    src="{{ asset("images/frontend") }}/payment-info.png" alt="How Much Can I Recive?" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade " id="pills-how-much-does-it-costs" role="tabpanel"
            aria-labelledby="pills-how-much-does-it-costs-tab">
            <div class="row align-items-center">
              <div class="col-md-6 order-1 order-md-0">
                <div class="content-block">
                  <h3 class="mb-4">How Much Does It Costs?</h3>
                  <div class="content">
                    <p>It's free for you to try here to manage your income and expenses.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 order-0 order-md-1 mb-5 mt-md-0">
                <div class="image-block text-center">
                  <img loading="lazy" decoding="async" src="{{ asset("images/frontend") }}/illustration-2.png" alt="How Much Does It Costs?" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade " id="pills-how-do-i-repay" role="tabpanel"
            aria-labelledby="pills-how-do-i-repay-tab">
            <div class="row align-items-center">
              <div class="col-md-6 order-1 order-md-0">
                <div class="content-block">
                  <h3 class="mb-4">How Do I Repay?</h3>
                  <div class="content">
                    <p> Take pictures of your receipts to auto-process and organize them.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 order-0 order-md-1 mb-5 mt-md-0">
                <div class="image-block text-center">
                  <img loading="lazy" decoding="async" src="{{ asset("images/frontend") }}/illustration-1.png" alt="How Do I Repay?" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</section >

{{-- <footer style="height:100px; background-color:bisque;"> --}}

@include("frontpages.partials.footer")


<!-- # JS Plugins -->
@include("frontpages.partials.footer-link")
