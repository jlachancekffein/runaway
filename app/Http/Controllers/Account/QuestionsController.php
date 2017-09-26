<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Profile;
use Auth;
use Illuminate\Support\Facades\Mail;

class QuestionsController extends Controller
{
    public function edit($questionId)
    {
        $user = Auth::user();
        $userPreferences = (array)json_decode($user->preferences, true);

        if (!array_key_exists('lastQuestionAnswered', $userPreferences)) {
            $userPreferences['lastQuestionAnswered'] = 0;
        }

        $questionId = max($questionId, 1);

        if ($questionId > $userPreferences['lastQuestionAnswered'] + 1) {
            return redirect('account/question/' . ($userPreferences['lastQuestionAnswered'] + 1));
        }

        $getQuestionPossibleValuesMethodName = 'getQuestion' . $questionId . 'PossibleValues';
        $fields = $this->$getQuestionPossibleValuesMethodName();

        return view('account.question' . $questionId, [
            'fields' => $fields,
            'preferences' => $userPreferences,
            'username' => $user->name,
            'email' => $user->email
        ]);
    }

    public function update(StoreQuestionRequest $request, $questionId)
    {
        $user = Auth::user();
        $userPreferences = (array)json_decode($user->preferences, true);
        $preferencesModification = false;

        $lastQuestionAnswered = $questionId;

        if (array_key_exists('lastQuestionAnswered', $userPreferences)) {
            $lastQuestionAnswered = max($lastQuestionAnswered, $userPreferences['lastQuestionAnswered']);

            if ($userPreferences['lastQuestionAnswered'] >= 9) {
                $preferencesModification = true;
            }
        }

        $getQuestionFieldsMethodName = 'getQuestion' . $questionId . 'PossibleValues';
        $fields = $this->$getQuestionFieldsMethodName();
        $fields = array_keys($fields);
        $input = $request->input('preferences');

        if ($questionId == 4) {

            if ($request->hasFile('preferences.photo')) {
                $photo = $request->file('preferences.photo');

                if ($photo->isValid()) {
                    $photoName = md5($user->email . config('questions.secret_file_upload_key'));
                    $photo->move('../storage/app/public/photos/', $photoName . '.jpg');

                    $input['photo'] = 1;
                }
            }
        }

        if ($questionId == 10) {
            $user->name = $input['name'];
        }

        // S'assure d'updater le user si un champ précédemment rempli deviens vide
        if (!is_array($input)) {
            $input = array();
        }

        foreach ($fields as $field) {
            if (!array_key_exists($field, $input)) {
                $input[$field] = array();
            }
        }

        $user->mergePreferences($input);
        $user->mergePreferences((array)array('lastQuestionAnswered' => $lastQuestionAnswered));
        $user->save();

        if ($preferencesModification) {
            $customerName = $user->name;
            $link = url('/admin/client/' . $user->id);
            $data = compact('customerName', 'link');

            Mail::send(['emails.preferencesModified', 'emails.preferencesModified-plain'], $data, function ($m) use ($customerName) {
                $m->to(trans('general.r2dEmail'), 'Runway 2 Doorway')->subject(trans('account.emailSubject', ['customerName' => $customerName]));
            });
        }

        $questionId++;
        $questionId = max(min($questionId, 11), 1);

        if ($request->ajax()) {
            return array('redirect' => '/account/question/' . $questionId);
        }

        return redirect('account/question/' . $questionId);
    }

    public function outputPhoto()
    {
        $user = Auth::user();

        $photoName = md5($user->email . config('questions.secret_file_upload_key'));
        $path = '../storage/app/public/photos/' . $photoName . '.jpg';

        return response()->file($path);
    }

    private function getQuestion1PossibleValues()
    {
        $styles = Profile::getStyles();

        return compact('styles');
    }

    private function getQuestion2PossibleValues()
    {
        $hairColors = Profile::getHairColors();
        $eyeColors = Profile::getEyeColors();
        $skinColors = Profile::getSkinColors();

        return compact('hairColors', 'eyeColors', 'skinColors');
    }

    private function getQuestion3PossibleValues()
    {
        $bodyShapes = Profile::getBodyShapes();

        return compact('bodyShapes');
    }

    private function getQuestion4PossibleValues()
    {
        return array();
    }

    private function getQuestion5PossibleValues()
    {
        $weightUnits = Profile::getWeightUnits();
        $favoritePants = Profile::getFavoritePants();

        return compact('weightUnits', 'favoritePants');
    }

    private function getQuestion6PossibleValues()
    {
        $excludedSkirts = Profile::getExcludedSkirts();
        $excludedPants = Profile::getExcludedPants();
        $excludedTops = Profile::getExcludedTops();
        $excludedNecks = Profile::getExcludedNecks();
        $excludedClothes = Profile::getExcludedClothes();
        $excludedColors = Profile::getExcludedColors();

        return compact('excludedSkirts', 'excludedPants', 'excludedTops', 'excludedNecks', 'excludedClothes', 'excludedColors');
    }

    private function getQuestion7PossibleValues()
    {
        $favoritePatterns = Profile::getfavoritePatterns();
        $favoriteAccessories = Profile::getfavoriteAccessories();
        $favoriteColors = Profile::getfavoriteColors();

        return compact('favoritePatterns', 'favoriteAccessories', 'favoriteColors');
    }

    private function getQuestion8PossibleValues()
    {
        $favoriteClothes = Profile::getfavoriteClothes();

        return compact('favoriteClothes');
    }

    private function getQuestion9PossibleValues()
    {
        $brands = Profile::getBrands();

        return compact('brands');
    }

    private function getQuestion10PossibleValues()
    {
        $provinces = array(
            'alberta' => trans('general.alberta'),
            'british-columbia' => trans('general.british-columbia'),
            'manitoba' => trans('general.manitoba'),
            'new-brunswick' => trans('general.new-brunswick'),
            'newfoundland-and-labrador' => trans('general.newfoundland-and-labrador'),
            'northwest-territories' => trans('general.northwest-territories'),
            'nova-scotia' => trans('general.nova-scotia'),
            'nunavut' => trans('general.nunavut'),
            'ontario' => trans('general.ontario'),
            'prince-edward-island' => trans('general.prince-edward-island'),
            'quebec' => trans('general.quebec'),
            'saskatchewan' => trans('general.saskatchewan'),
            'yukon' => trans('general.yukon')
        );

        asort($provinces);

        return compact('provinces');
    }

    private function getQuestion11PossibleValues()
    {
        return array();
    }
}
