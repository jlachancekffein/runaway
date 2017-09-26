<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CompleteProfile
{

    const NUMBER_OF_QUESTIONS = 10;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            $lastQuestionAnswered = $this->getLastQuestionAnsweredByUser($user);

            if ($lastQuestionAnswered === self::NUMBER_OF_QUESTIONS) {
                return $next($request);
            }

            if ($request->ajax()) {
                return array('redirect' => $this->getQuestionUrl($lastQuestionAnswered) . '?message=' . trans('account.mustCompleteForm'));
            }

            return redirect($this->getQuestionUrl($lastQuestionAnswered) . '?message=' . trans('account.mustCompleteForm'));
        }

        return $next($request);
    }

    private function getLastQuestionAnsweredByUser(User $user)
    {
        $userPreferences = (array) json_decode($user->preferences);

        if (!array_key_exists('lastQuestionAnswered', $userPreferences)) {
            $userPreferences['lastQuestionAnswered'] = 0;
        }

        return (int) $userPreferences['lastQuestionAnswered'];
    }

    private function getQuestionUrl($questionIndex)
    {
        return '/account/question/' . min($questionIndex + 1, self::NUMBER_OF_QUESTIONS);
    }
}
