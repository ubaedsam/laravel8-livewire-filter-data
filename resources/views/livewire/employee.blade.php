<div class="container mx-auto">
    <div class="flex space-x-2 justify-end pt-4 pb-3 pl-10 mr-10">
        <a href="{{ route('all-employee.add') }}" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Tambah Data</a>
    </div>
    <h1 class="text-3xl text-blue-600/100 text-center pt-5 font-bold">
        Website Employee Sederhana (Karyawan)
    </h1>
    <form class="text-center pt-5" wire:submit.prevent="searching">
      <input wire:model="search" type="search" placeholder="Nama Employee">
      <select wire:model="jabatan" class="form-control">
        <option value="">Pilih Jabatan</option>
        @foreach ($jabatans as $jabatan)
            <option value="{{ $jabatan->id }}">{{ $jabatan->jabatan }}</option>
        @endforeach
      </select>
      <br>
      <br>
      <select wire:model="team" class="form-control">
        <option value="">Pilih Team</option>
        @foreach ($teams as $team)
            <option value="{{ $team->id }}">{{ $team->nama }}</option>
        @endforeach
      </select>
      <br>
      <br>
      <div class="">
        <label for="">Per Page</label>
        <select class="form-control" wire:model="perPage">
          <option value="5">5</option>
          <option value="15">15</option>
          <option value="25">25</option>
          <option value="50">50</option>
        </select>
      </div>
      <br>
      <br>
      <div class="">
        <label for="">Order By</label>
        <select class="form-control" wire:model="by">
          <option value="asc">Ascending</option>
          <option value="desc">Descending</option>
        </select>
      </div>
      <br>
      <br>
      <div class="harga">
        <div class="widget mercado-widget filter-widget price-filter">
          <h2 class="widget-title">Harga <span class="text-info">Rp. {{ $min_usia }} - Rp. {{ $max_usia }}</span></h2>
          <div class="widget-content" style="padding: 10px 5px 40px 5px;">
            <div id="slider" wire:ignore></div>
          </div>
        </div><!-- Price-->
      </div>


      {{--  <input type="submit" value="Search">  --}}

    </form>
    <div class="flex justify-center pt-5">
        <table class="border-separate border border-blue-600">
            <thead>
              <tr>
                <th class="border border-blue-600 p-5">Id</th>
                <th class="border border-blue-600 p-5">Nama</th>
                <th class="border border-blue-600 p-5">Usia</th>
                <th class="border border-blue-600 p-5">Tanggal Lahir</th>
                <th class="border border-blue-600 p-5">Jabatan</th>
                <th class="border border-blue-600 p-5">Team</th>
                <th class="border border-blue-600 p-5">Action</th>
              </tr>
            </thead>
            <tbody id="tbody">
              @if (count($employees) > 0)
                @foreach ($employees as $employee)
                <tr>
                  <td class="border border-blue-600 text-center p-2">{{ $employee->id }}</td>
                  <td class="border border-blue-600 text-center p-2">{{ $employee->nama }}</td>
                  <td class="border border-blue-600 text-center p-2">{{ $employee->usia }} Tahun</td>
                  <td class="border border-blue-600 text-center p-2">{{ $employee->tanggal_lahir }}</td>
                  <td class="border border-blue-600 text-center p-2">{{ $employee->jabatan->jabatan }}</td>
                  <td class="border border-blue-600 text-center p-2">{{ $employee->team->nama }}</td>
                  <td class="border border-blue-600 text-center p-2">
                    <a href="{{ route('all-employee.edit',['employee_id'=>$employee->id]) }}" class="inline-block px-6 py-2.5 bg-yellow-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-700 hover:shadow-lg focus:bg-yellow-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-800 active:shadow-lg transition duration-150 ease-in-out">Ubah</a>
                    <a href="{{route('all-employee.detail',['employee_id'=>$employee->id])}}" class="inline-block px-6 py-2.5 bg-blue-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-600 hover:shadow-lg focus:bg-blue-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-700 active:shadow-lg transition duration-150 ease-in-out">Detail</a>
                    <a href="#" onclick="confirm('Apakah anda yakin ingin menghapus data employee karyawan ini ?') || event.stopImmediatePropagation()" wire:click.prevent="hapusEmployee({{ $employee->id }})" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" style="margin-left: 10px;">Hapus</a>
                  </td>
                </tr>
                @endforeach
              @else
                <tr>
                  <td>Data Tidak Ditemukan</td>
                </tr>
              @endif
            </tbody>
        </table>
    </div>
    <div class="mb-10">
    {{ $employees->links() }}
    </div>
  </div>

  @push('scripts')
	<script>
		// menselect data dengan id slider
		var slider = document.getElementById('slider');
		noUiSlider.create(slider,{
			start : [0,20],
			connect:true,
			range : {
				'min' : 0,
				'max' : 20
			}
		});

		// memproses data filter harga
		slider.noUiSlider.on('update',function(value){
			@this.set('min_usia',value[0]); // harga paling rendah
			@this.set('max_usia',value[1]); // harga paling tinggi
		})
	</script>
@endpush

  {{--  <script>
    $(document).ready(function(){
      $("#jabatan").on('change',function(){
        var jabatan = $(this).val();
        $.ajax({
          url:"{{ route('employee') }}",
          type:"GET",
          data:{'jabatan':jabatan},
          success:function(data){
            var employees = data.employees;
            var html = '';
            if (employees.length > 0){
              for(let i = 0; i<employees.length;i++){
                html += '<tr>\
                  <td>'+(i+1)+'</td>\
                  <td>'+employees[i]['nama']+'</td>\
                  <td>'+employees[i]['usia']+'</td>\
                  <td>'+employees[i]['tanggal_lahir']+'</td>\
                  <td>'+employees+jabatan[i]['jabatan']+'</td>\
                  </tr>';
              }
            }else{
              html += '<tr>\
                <td>Data Tidak Ditemukan</td>\
                </tr>';
            }

            $("#tbody").html(html);
          }
        });
      });
    });
  </script>  --}}