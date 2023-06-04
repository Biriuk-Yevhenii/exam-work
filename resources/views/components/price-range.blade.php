<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="range" class="custom-range" id="{{ $name }}" name="{{ $name }}" min="{{ $min }}" max="{{ $max }}" step="{{ $step }}" value="{{ $value }}">
    <div class="d-flex justify-content-between">
      <small>{{ $min_label }}</small>
      <small>{{ $max_label }}</small>
    </div>
</div>