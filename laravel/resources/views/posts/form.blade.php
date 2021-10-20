@csrf
<div class="md-form">
  <label>場所名</label>
  <input type="text" name="place_name" class="form-control" required value="{{ old('place_name') }}">
</div>
<div class="md-form">
  <label>グッドポイント！</label>
  <input type="text" name="good_point" class="form-control" required value="{{ old('good_point') }}">
</div>
<div class="form-group">
  <label></label>
  <textarea name="body" class="form-control" rows="16" placeholder="本文">{{ old('body') }}</textarea>
</div>
