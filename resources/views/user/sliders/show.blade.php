<div class="card-columns">
    @foreach ($swiper as $swiper)
        @php
            $images = json_decode($swiper->image);
            $imageCount = count($images);
        @endphp
        @if (!is_null($images) && is_array($images) && $imageCount > 0)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Images</h5>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($images as $index => $image)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset($image) }}" class="d-block w-100" alt="Property Image" style="max-height: 400px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
