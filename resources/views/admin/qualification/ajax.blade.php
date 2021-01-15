@if(isset($id) || isset($prof))
    <div class="form-group row">
        <label class="col-md-3">1-й {{$prof}}</label>
        <div class="col-md-9">
            <select required name="subject_id" class="form-control city">
                <option></option>
                @foreach($subjects as $i)
                    <option @if(is_object($specialty) && $specialty->subject_id == $i->id) selected @endif value="{{ $i->id }}">{{ $i->name_ru }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-3">2-й {{$prof}}</label>
        <div class="col-md-9">
            <select required name="subject_id2" class="form-control city">
                <option></option>
                @foreach($subjects as $i)
                    <option @if(is_object($specialty) && $specialty->subject_id2 == $i->id) selected @endif value="{{ $i->id }}">{{ $i->name_ru }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif
