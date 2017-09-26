<div class="question-progression">
    @for ($i = 1; $i <= 10; $i++)
        @if ($i == $current)
            <span class="question-progressionNumber-current">{{ $current }}</span>
        @elseif ($preferences['lastQuestionAnswered']+1 > $i)
            <a class="question-progressionNumber-done" href="{{ url('account/question/' . $i) }}?modify=1">{{ $i }}</a>
        @elseif ($preferences['lastQuestionAnswered']+1 == $i)
            <a class="question-progressionNumber-done" href="{{ url('account/question/' . $i) }}">{{ $i }}</a>
        @else
            <span class="question-progressionNumber">{{ $i }}</span>
        @endif
    @endfor
    
    <select class="question-progressionSelect js-select2 js-question-progressionSelect" name="question-progressionSelect">
        @for ($i = 1; $i <= 10; $i++)
            <option value="{{ url('account/question/' . $i) }}"{{ $i == $current ? 'selected="selected"' : '' }}>{{ trans('questions.title-' . $i) }}</option>
        @endfor
    </select>
</div>