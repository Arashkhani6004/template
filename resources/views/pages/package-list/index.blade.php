@extends('layouts.main.master')
@push('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/packages/list.css?v0.01')}}">
@endpush
@section('robots', @$seo_data['noindex'] == 0 ? 'index,follow' : 'noindex,nofollow')
@section('title_seo',@$seo_data['title_seo'] ? @$seo_data['title_seo'] : "پکیج ها")
@section('description_seo',@$seo_data['description_seo'] ? @$seo_data['description_seo'] : "پکیج های سالن زیبایی")
@section('content')
@include('pages.package-list._partials.header-inner')
@include('layouts.common.banner-scrollable-animation')
<section class="packages list mt-5">
    <div class="container">
        <div class="row w-100 m-0">
            @forelse($packages as $package)
            <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-6 p-lg-2 p-1">
                <div class="package-card">
                    <a href="{{ route('package.detail', ['url' => $package['url']]) }}" class="color-title text-start h-rotate">
                        <div class="d-flex justify-content-end pb-4">
                            <span class="arrow">
                                <img src="{{asset('assets/site/images/left-top-arrow.svg')}}" class="main-icon"
                                    alt="package-icon" title="package-icon">
                            </span>
                        </div>
                        <div class="package-title pb-3">
                            <p class="font-re m-0">
                                {{$package['title']}}
                            </p>
                        </div>
                        <img src="{{$package->getImage()}}" class="w-100 main-image"
                             alt="{{$package['title']}}"
                             title="{{$package['title']}}">
                        <ul class="p-0 m-0 py-4">
                            @foreach($package['services'] as $package_service)
                                <li class="d-flex align-items-center pb-2 font-th">
                                    <img src="{{asset('assets/site/images/check-success.svg')}}"
                                         class="me-2" width="20" height="20"
                                         alt="{{$package_service['title']}}" title="{{$package_service['title']}}">
                                    {{$package_service['title']}}
                                </li>
                            @endforeach
                        </ul>
                        <hr>
                        <p class="d-flex m-0 align-items-center main-price">
                            <span class="me-1">
                             {{$package['discounted_price']}}
                            </span>
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.77236 1.36044L5.17314 0L6.60325 1.37511L5.18047 2.73371L3.77236 1.36044ZM9.69448 5.90745C9.69448 7.04787 9.40113 7.94444 8.81808 8.59716C8.44956 9.00236 7.97102 9.31221 7.38247 9.52306C6.74225 9.73425 6.07084 9.83531 5.39682 9.82192H4.37924C3.60735 9.82192 2.91063 9.68624 2.29092 9.41305C1.62143 9.13137 1.04816 8.66129 0.640791 8.05995C0.20651 7.37702 -0.0161189 6.58091 0.00090861 5.77177C0.00090861 5.6636 0.00274199 5.55726 0.00824241 5.44908C0.0632466 4.44067 0.382271 3.32592 0.970816 2.09933L2.97847 2.98673C2.50727 3.96214 2.25058 4.8202 2.21024 5.55909C2.20658 5.63243 2.20291 5.70577 2.20291 5.77911C2.20291 6.24114 2.30375 6.61884 2.50727 6.9122C2.72606 7.23056 3.05104 7.46064 3.424 7.56125C3.57985 7.61258 3.75036 7.64925 3.93371 7.67125C4.07855 7.68959 4.22707 7.69692 4.37924 7.69692H5.39682C6.23655 7.69692 6.80676 7.54841 7.10745 7.24955C7.36414 6.9947 7.49248 6.54733 7.49248 5.90929V1.87014H9.69265V5.90745H9.69448ZM19.6557 11.7452L18.3356 10.4618L19.6356 9.16737L20.9832 10.4636L19.6557 11.7452ZM14.4193 12.3099C15.4131 12.3099 16.2033 12.6583 16.79 13.3532C17.3346 13.9876 17.6059 14.7778 17.6059 15.7239V16.3913H17.9359V16.3839H18.6877C19.0929 16.3839 19.3789 16.3326 19.5439 16.2299C19.7144 16.1291 19.8006 15.9732 19.8006 15.7569V15.6304C19.8079 15.1848 19.8318 13.7162 19.8006 13.586L22.0026 12.926V15.8119C22.0082 16.3832 21.823 16.94 21.4764 17.3942C20.9153 18.1367 20.0023 18.5071 18.7353 18.5071H17.5858C17.4739 19.851 16.79 20.8118 15.5378 21.3911C15.0482 21.6148 14.4743 21.7762 13.8198 21.877C13.2653 21.9618 12.705 22.0028 12.144 21.9998V19.8749C13.2661 19.8749 14.1095 19.7245 14.6742 19.422C15.1326 19.18 15.3636 18.8756 15.3636 18.5071H14.4193C13.62 18.5071 12.9397 18.2999 12.3787 17.8855C11.7058 17.385 11.3703 16.6626 11.3703 15.722C11.3703 14.8273 11.594 14.0701 12.0432 13.4485C12.5859 12.6876 13.3779 12.3081 14.4193 12.3081V12.3099ZM15.3966 16.3913V15.7239C15.3966 15.326 15.3086 15.0106 15.1344 14.7778C15.052 14.6669 14.9439 14.5777 14.8193 14.518C14.6947 14.4582 14.5574 14.4297 14.4193 14.4349C14.2798 14.4301 14.141 14.4587 14.0147 14.5183C13.8884 14.578 13.7782 14.6669 13.6933 14.7778C13.5186 15.0157 13.4306 15.3062 13.4439 15.601C13.4437 15.642 13.4455 15.683 13.4494 15.7239C13.4641 15.9531 13.5704 16.1272 13.774 16.2427C13.9445 16.3418 14.159 16.3894 14.4193 16.3894L15.3966 16.3913ZM15.5854 10.4636L16.9055 11.7471L18.233 10.4636L16.8854 9.16737L15.5854 10.4636ZM3.31216 19.4257H3.36717C4.16106 19.4073 4.7331 19.2313 5.08513 18.8939C5.12913 18.9159 5.20431 18.9581 5.30515 19.0186L5.44083 19.0901L5.58934 19.1671C5.83686 19.301 6.06787 19.411 6.28422 19.4972C6.91677 19.7648 7.51265 19.9005 8.07553 19.9005C8.36937 19.9069 8.66158 19.8551 8.93533 19.7481C9.20908 19.6411 9.45898 19.4811 9.67065 19.2771C10.2207 18.7546 10.4939 17.968 10.4939 16.9193C10.4874 16.1762 10.2747 15.4494 9.87966 14.82C9.33146 13.9821 8.53756 13.564 7.49615 13.564C6.57574 13.564 5.81669 13.9161 5.21897 14.6183C5.01179 14.8603 4.83395 15.139 4.67993 15.4543C4.62126 15.568 4.56993 15.6835 4.52592 15.8045C4.50366 15.8506 4.48526 15.8984 4.47092 15.9476C4.45677 15.984 4.44332 16.0206 4.43058 16.0576C4.24173 16.6241 4.11706 16.9468 4.05472 17.0293C3.92271 17.1943 3.66236 17.286 3.27183 17.2988C3.04631 17.2897 2.88863 17.2438 2.80246 17.1595C2.69795 17.0605 2.64661 16.879 2.64661 16.6149V11.0008L0.444609 10.0841V16.6149C0.444609 17.0935 0.532616 17.5243 0.706796 17.9039C0.836973 18.1936 1.01482 18.4466 1.2385 18.6611C1.46402 18.8774 1.72621 19.048 2.0269 19.1745C2.38992 19.3285 2.79696 19.4128 3.24616 19.4238V19.4257H3.31216ZM8.35788 17.5665C8.4344 17.3599 8.46201 17.1384 8.43855 16.9193C8.42407 16.6087 8.3189 16.3091 8.13603 16.0576C7.95268 15.8119 7.73817 15.689 7.49432 15.689C7.16429 15.689 6.88927 15.8779 6.67475 16.2574C6.59775 16.3876 6.52808 16.5471 6.46574 16.7378C6.43939 16.8105 6.41493 16.8838 6.3924 16.9578L6.3649 17.055L6.33739 17.1393C6.59775 17.3557 6.92961 17.5353 7.3348 17.6765C7.66483 17.7902 7.93068 17.8452 8.1287 17.8452C8.20937 17.8452 8.28638 17.7535 8.35788 17.5665Z"
                                    fill="#252525" />
                            </svg>
                        </p>
                        @if($package['price'] != 0)
                        <p class="d-flex m-0 align-items-center old-price">
                            <del class="me-1">
                                {{$package['price']}}
                            </del>
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.77236 1.36044L5.17314 0L6.60325 1.37511L5.18047 2.73371L3.77236 1.36044ZM9.69448 5.90745C9.69448 7.04787 9.40113 7.94444 8.81808 8.59716C8.44956 9.00236 7.97102 9.31221 7.38247 9.52306C6.74225 9.73425 6.07084 9.83531 5.39682 9.82192H4.37924C3.60735 9.82192 2.91063 9.68624 2.29092 9.41305C1.62143 9.13137 1.04816 8.66129 0.640791 8.05995C0.20651 7.37702 -0.0161189 6.58091 0.00090861 5.77177C0.00090861 5.6636 0.00274199 5.55726 0.00824241 5.44908C0.0632466 4.44067 0.382271 3.32592 0.970816 2.09933L2.97847 2.98673C2.50727 3.96214 2.25058 4.8202 2.21024 5.55909C2.20658 5.63243 2.20291 5.70577 2.20291 5.77911C2.20291 6.24114 2.30375 6.61884 2.50727 6.9122C2.72606 7.23056 3.05104 7.46064 3.424 7.56125C3.57985 7.61258 3.75036 7.64925 3.93371 7.67125C4.07855 7.68959 4.22707 7.69692 4.37924 7.69692H5.39682C6.23655 7.69692 6.80676 7.54841 7.10745 7.24955C7.36414 6.9947 7.49248 6.54733 7.49248 5.90929V1.87014H9.69265V5.90745H9.69448ZM19.6557 11.7452L18.3356 10.4618L19.6356 9.16737L20.9832 10.4636L19.6557 11.7452ZM14.4193 12.3099C15.4131 12.3099 16.2033 12.6583 16.79 13.3532C17.3346 13.9876 17.6059 14.7778 17.6059 15.7239V16.3913H17.9359V16.3839H18.6877C19.0929 16.3839 19.3789 16.3326 19.5439 16.2299C19.7144 16.1291 19.8006 15.9732 19.8006 15.7569V15.6304C19.8079 15.1848 19.8318 13.7162 19.8006 13.586L22.0026 12.926V15.8119C22.0082 16.3832 21.823 16.94 21.4764 17.3942C20.9153 18.1367 20.0023 18.5071 18.7353 18.5071H17.5858C17.4739 19.851 16.79 20.8118 15.5378 21.3911C15.0482 21.6148 14.4743 21.7762 13.8198 21.877C13.2653 21.9618 12.705 22.0028 12.144 21.9998V19.8749C13.2661 19.8749 14.1095 19.7245 14.6742 19.422C15.1326 19.18 15.3636 18.8756 15.3636 18.5071H14.4193C13.62 18.5071 12.9397 18.2999 12.3787 17.8855C11.7058 17.385 11.3703 16.6626 11.3703 15.722C11.3703 14.8273 11.594 14.0701 12.0432 13.4485C12.5859 12.6876 13.3779 12.3081 14.4193 12.3081V12.3099ZM15.3966 16.3913V15.7239C15.3966 15.326 15.3086 15.0106 15.1344 14.7778C15.052 14.6669 14.9439 14.5777 14.8193 14.518C14.6947 14.4582 14.5574 14.4297 14.4193 14.4349C14.2798 14.4301 14.141 14.4587 14.0147 14.5183C13.8884 14.578 13.7782 14.6669 13.6933 14.7778C13.5186 15.0157 13.4306 15.3062 13.4439 15.601C13.4437 15.642 13.4455 15.683 13.4494 15.7239C13.4641 15.9531 13.5704 16.1272 13.774 16.2427C13.9445 16.3418 14.159 16.3894 14.4193 16.3894L15.3966 16.3913ZM15.5854 10.4636L16.9055 11.7471L18.233 10.4636L16.8854 9.16737L15.5854 10.4636ZM3.31216 19.4257H3.36717C4.16106 19.4073 4.7331 19.2313 5.08513 18.8939C5.12913 18.9159 5.20431 18.9581 5.30515 19.0186L5.44083 19.0901L5.58934 19.1671C5.83686 19.301 6.06787 19.411 6.28422 19.4972C6.91677 19.7648 7.51265 19.9005 8.07553 19.9005C8.36937 19.9069 8.66158 19.8551 8.93533 19.7481C9.20908 19.6411 9.45898 19.4811 9.67065 19.2771C10.2207 18.7546 10.4939 17.968 10.4939 16.9193C10.4874 16.1762 10.2747 15.4494 9.87966 14.82C9.33146 13.9821 8.53756 13.564 7.49615 13.564C6.57574 13.564 5.81669 13.9161 5.21897 14.6183C5.01179 14.8603 4.83395 15.139 4.67993 15.4543C4.62126 15.568 4.56993 15.6835 4.52592 15.8045C4.50366 15.8506 4.48526 15.8984 4.47092 15.9476C4.45677 15.984 4.44332 16.0206 4.43058 16.0576C4.24173 16.6241 4.11706 16.9468 4.05472 17.0293C3.92271 17.1943 3.66236 17.286 3.27183 17.2988C3.04631 17.2897 2.88863 17.2438 2.80246 17.1595C2.69795 17.0605 2.64661 16.879 2.64661 16.6149V11.0008L0.444609 10.0841V16.6149C0.444609 17.0935 0.532616 17.5243 0.706796 17.9039C0.836973 18.1936 1.01482 18.4466 1.2385 18.6611C1.46402 18.8774 1.72621 19.048 2.0269 19.1745C2.38992 19.3285 2.79696 19.4128 3.24616 19.4238V19.4257H3.31216ZM8.35788 17.5665C8.4344 17.3599 8.46201 17.1384 8.43855 16.9193C8.42407 16.6087 8.3189 16.3091 8.13603 16.0576C7.95268 15.8119 7.73817 15.689 7.49432 15.689C7.16429 15.689 6.88927 15.8779 6.67475 16.2574C6.59775 16.3876 6.52808 16.5471 6.46574 16.7378C6.43939 16.8105 6.41493 16.8838 6.3924 16.9578L6.3649 17.055L6.33739 17.1393C6.59775 17.3557 6.92961 17.5353 7.3348 17.6765C7.66483 17.7902 7.93068 17.8452 8.1287 17.8452C8.20937 17.8452 8.28638 17.7535 8.35788 17.5665Z"
                                    fill="#252525" />
                            </svg>
                        </p>
                        @endif
                    </a>
                </div>
            </div>
            @empty
{{--            //Todo ui : قسمت خالی بودن پکیج--}}
            @endforelse
        </div>


    </div>
</section>

@stop