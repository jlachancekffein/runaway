<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Profile;

class StoreQuestionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $questionId = max(min($this->questionId, 11), 1);
        $methodName = "question{$questionId}Rules";
        
        return $this->$methodName();
    }
    
    private function question1Rules() {
        $styles = Profile::getStyles();
        
        return [
            'preferences.styles.*' => 'in:' . implode(',', $styles),
        ];
    }
    
    private function question2Rules() {
        $hairColors = Profile::getHairColors();
        $eyeColors = Profile::getEyeColors();
        $skinColors = Profile::getSkinColors();
        
        return [
            'preferences.hairColor' => 'required',
            'preferences.hairColor.*' => 'in:' . implode(',', $hairColors),
            'preferences.eyeColor' => 'required',
            'preferences.eyeColor.*' => 'in:' . implode(',', $eyeColors),
            'preferences.skinColor' => 'required',
            'preferences.skinColor.*' => 'in:' . implode(',', $skinColors)
        ];
    }
    
    private function question3Rules() {
        $bodyShapes = Profile::getBodyShapes();
        
        return [
            'preferences.bodyShape' => 'required',
            'preferences.bodyShape.*' => 'in:' . implode(',', $bodyShapes)
        ];
    }
    
    private function question4Rules() {
        return [
            'preferences.photo' => 'image|max:5000|dimensions:min_width=250,min_height=250'
        ];
    }
    
    private function question5Rules() {
        $weightUnits = Profile::getWeightUnits();
        $favoritePants = Profile::getFavoritePants();
        
        return [
            'preferences.height' => 'required|integer',
            'preferences.weight' => 'required|integer',
            'preferences.weightUnit' => 'required',
            'preferences.weightUnit.*' => 'in:' . implode(',', $weightUnits),
            'preferences.braBandSize' => 'required|string',
            'preferences.braCupSize' => 'required|string',
            'preferences.shoeSize' => 'required',
            'preferences.allergies' => 'string',
            'preferences.pantsSize' => 'required|integer',
            'preferences.favoritePants' => 'required',
            'preferences.favoritePants.*' => 'in:' . implode(',', $favoritePants),
            'preferences.shirtSize' => 'required|integer',
            'preferences.dressSize' => 'required|integer',
            'preferences.piercedEars' => 'required',
            'preferences.piercedEars.*' => 'boolean'
        ];
    }
    
    private function question6Rules() {
        $excludedSkirts = Profile::getExcludedSkirts();
        $excludedPants = Profile::getExcludedPants();
        $excludedTops = Profile::getExcludedTops();
        $excludedNecks = Profile::getExcludedNecks();
        $excludedClothes = Profile::getExcludedClothes();
        $excludedColors = Profile::getExcludedColors();
        
        return [
            'preferences.excludedSkirts.*' => 'in:' . implode(',', $excludedSkirts),
            'preferences.excludedPants.*' => 'in:' . implode(',', $excludedPants),
            'preferences.excludedTops.*' => 'in:' . implode(',', $excludedTops),
            'preferences.excludedNecks.*' => 'in:' . implode(',', $excludedNecks),
            'preferences.excludedClothes.*' => 'in:' . implode(',', $excludedClothes),
            'preferences.excludedColors.*' => 'in:' . implode(',', $excludedColors)
        ];
    }
    
    private function question7Rules() {
        $favoritePatterns = Profile::getfavoritePatterns();
        $favoriteAccessories = Profile::getfavoriteAccessories();
        $favoriteColors = Profile::getfavoriteColors();
        
        return [
            'preferences.favoritePatterns.*' => 'in:' . implode(',', $favoritePatterns),
            'preferences.favoriteAccessories.*' => 'in:' . implode(',', $favoriteAccessories),
            'preferences.favoriteColors.*' => 'in:' . implode(',', $favoriteColors)
        ];
    }
    
    private function question8Rules() {
        $favoriteClothes = Profile::getfavoriteClothes();
        
        return [
            'preferences.favoriteClothes.*' => 'in:' . implode(',', $favoriteClothes)
        ];
    }
    
    private function question9Rules() {
        $brands = Profile::getBrands();
        
        return [
            'preferences.brands.*' => 'in:' . implode(',', $brands)
        ];
    }
    
    private function question10Rules() {
        $provinces = array(
            'alberta',
            'british-columbia',
            'manitoba',
            'new-brunswick',
            'newfoundland-and-labrador',
            'northwest-territories',
            'nova-scotia',
            'nunavut',
            'ontario',
            'prince-edward-island',
            'quebec',
            'saskatchewan',
            'yukon'
        );
        
        return [
            'preferences.name' => 'required|string',
            'preferences.address' => 'required|string',
            'preferences.city' => 'required|string',
            'preferences.postal_code' => 'required|string',
            'preferences.province' => 'required|string|in:' . implode(',', $provinces),
            'preferences.phone' => 'required|string',
            'preferences.contact_method' => 'required|string',
            'preferences.contact_hours' => 'required_if:preferences.contact_method,phone|string',
            'preferences.birthday.year' => 'required|numeric|between:1900,' . date('Y'),
            'preferences.birthday.month' => 'required|numeric|between:1,12',
            'preferences.birthday.day' => 'required|numeric|between:1,31',
            'preferences.terms' => 'required'
        ];
    }
    
    private function question11Rules() {
        return array();
    }
}
