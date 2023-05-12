<style>
    .data {
        background: #fff;
        overflow: hidden;
        padding: 5px 0px;
        line-height: 1.6;
        border-radius: 0 0 10px 10px;
        text-align: center;
        box-shadow: 0px 6px 11px -5px #0000006b;
    }
    .data a {
        font-size: 18px;
        text-decoration: none;
        color: #444343;
    }
    .data div {
        position: relative;
        background: white;
    }
    .data div::after {
        position: absolute;
        content: '';
        background: #7fc540;
        width: 100%;
        height: 2px;
        bottom: 0;
        left: 0;
    }

    .data div:hover {
        background: #e5eaf4;
    }

    .data div:hover a {
        color: #0d64b0;
    }
    .result {
        position: absolute;
        z-index: 26;
        width: 75%;

    }
    .search {
        border: 1px solid #dee2e6 !important;
        border-radius: 4px;
        text-align: center;
        padding: 10px;
        width: 330px !important;
    }
    @media (max-width: 700px) {
        .data {
            width: 100%;
        }
        .result {
            max-width:  95.5%;
            top: 50px;
        }
    }
     
</style>
{{-- <div id="searchBar" class="container mb-4" style="position: relative" > --}}
    <form class="d-flex" role="search" method="post" action="{{route('search')}}" id="search-form" onsubmit="event.preventDefault();">
        {{ csrf_field() }}
        <input class="form-control mr-2 " type="search" placeholder="Search..." aria-label="Search" name="search" id="search" minlength="2" maxlength="20" required>
        
        {{-- <i class="fa-solid fa-magnifying-glass pt-1" style="font-size: 24px; color:#7fc540"></i> --}}
    </form>
    <div class="result">
    </div>
{{-- </div> --}}