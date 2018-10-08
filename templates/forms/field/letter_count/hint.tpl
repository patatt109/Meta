<div class="field-letter-count__value hint">
    <span class="field-letter-count__text">
        {t "Meta.main" "Symbols count"}:
    </span>
    <span class="field-letter-count__value" id="{$id}-value">
        {$field->getRenderValue()|length}
    </span>
</div>

<script>
    (function () {
        document.getElementById('{$id}').onkeyup = function () {
            document.getElementById('{$id}-value').textContent = this.value.length;
        }
    })();
</script>