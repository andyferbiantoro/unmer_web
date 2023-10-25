
              @if($data->kategori_produk == 'Pakaian')
              <div class="form-group">
                <div class="row">
                  <div id="size_id" class="col-lg-6 col-sm-12 col-12" >
                    <label><strong>Size</strong></label><br>
                    @foreach($list_size as $list)
                    <label><input type="checkbox" name="size[]" value="{{$list->size}}"  > {{$list->size}}</label><br>
                    @endforeach

                  </div>

                  <div id="warna_id" class="col-lg-6 col-sm-12 col-12">
                    <label><strong>Warna</strong></label><br>
                     @foreach($list_warna as $list)
                    <label><input type="checkbox" name="warna[]" value="{{$list->warna}}"  > {{$list->warna}}</label><br>
                    @endforeach

                  </div>
                </div>
              </div>  
              @endif