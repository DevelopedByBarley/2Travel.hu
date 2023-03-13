<div class="container text-center border rounded" id="search-box">
    <div class="row">
        <div class="col">
            <h1 class="display-6 mt-5 mb-5">Hová utaznál?
                <span><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-airplane" viewBox="0 0 16 16">
                        <path d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.376-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849Zm.894.448C7.111 2.02 7 2.569 7 3v4a.5.5 0 0 1-.276.447l-5.448 2.724a.5.5 0 0 0-.276.447v.792l5.418-.903a.5.5 0 0 1 .575.41l.5 3a.5.5 0 0 1-.14.437L6.708 15h2.586l-.647-.646a.5.5 0 0 1-.14-.436l.5-3a.5.5 0 0 1 .576-.411L15 11.41v-.792a.5.5 0 0 0-.276-.447L9.276 7.447A.5.5 0 0 1 9 7V3c0-.432-.11-.979-.322-1.401C8.458 1.159 8.213 1 8 1c-.213 0-.458.158-.678.599Z" />
                    </svg></span>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form>
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4 d-flex align-items-center justify-content-center">
                    <div class="col-12 col-md-2">
                        <div class="form-outline">
                            <label class="form-label" for="form3Example1">Hol?</label>
                            <input type="text" id="form3Example1" class="form-control" placeholder="Úti célok keresése" />
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-outline">
                            <label class="form-label" for="form3Example2">Érkezés</label>
                            <input type="date" id="form3Example2" class="form-control" />
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-outline">
                            <label class="form-label" for="form3Example2">Távozás</label>
                            <input type="date" id="form3Example2" class="form-control" />
                        </div>
                    </div>
                    <div class="col-12 col-md-2 mt-3" style="position:relative; top: 8px;">
                        <div class="guestCounter-container">
                            <button class="btn btn-outline-primary" onclick="setCountOfPeoplesToggler(event)">Hányan?</button>
                            <div id="guestCounter" style="min-height: 40px">
                                <ul class="list-group">
                                    <li class="list-group-item">

                                        <p>Felnőtt</p>
                                        <input value="0" type="number">

                                    </li>
                                    <li class="list-group-item">
                                        <p>Gyerek</p>
                                        <input value="0" type="number">

                                    </li>
                                    <li class="list-group-item">
                                        <p>Csecsemő</p>
                                        <input value="0" type="number">

                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 col-md-1">
                        <button type="submit" class="btn btn-primary btn-block mt-4" style="position: relative; top: 6px;">Keresés</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    /* Set up the initial state of the element */
    #search-box {
        display: none;
        opacity: 0;
        /* Start with a transparent element */
        position: relative;
        /* Needed for absolute positioning */
        top: -100%;
        /* Start off the top of the screen */
    }

    #search-box.active {
        display: block;
        animation-name: fade-in-from-top;
        animation-duration: 1s;
        /* How long the animation should take */
        animation-fill-mode: forwards;
        /* Keep the element in its final state after the animation */
    }

    /* Define the animation */
    @keyframes fade-in-from-top {
        0% {
            opacity: 0;
            top: -100%;
        }

        100% {
            opacity: 1;
            top: 0;
        }
    }

    .guestCounter-container {
        position: relative;
    }

    #guestCounter {
        display: none;
        background-color: red;
        min-width: 100%;
    }

    @media(min-width: 768px) {
        #guestCounter {
        position: absolute;
        top: 40px;
        left: 0;
    }
    }

    #guestCounter.active {
        display: block;
    }
</style>