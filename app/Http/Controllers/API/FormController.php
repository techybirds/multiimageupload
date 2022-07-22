<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormValidationRequest;
use App\Models\FormImage;
use App\Models\GeneralForm;
use App\Models\StatusCode;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;

class FormController extends Controller
{
    use ImageUpload;

    /**
     * API to save textual details of form.
     *
     * @param FormValidationRequest $request
     * @return mixed
     */
    public function saveFormDetails(FormValidationRequest $request)
    {
        $new_form = new GeneralForm();

        $new_form->title = $request->title;
        $new_form->description = $request->description;

        $new_form->save();

        return response()->api(StatusCode::TRUE, 'From submit successfully', [
            'form_id' => $new_form->id
        ]);
    }

    /**
     * API method to store uploaded images under the form id
     * @param Request $request
     * @return mixed
     */
    public function saveImages(Request $request)
    {
        $form_id = $request->form_id;

        $form = GeneralForm::find($form_id);

        if(false == $form){
            return response()->api(StatusCode::FALSE, 'Invalid form id', null);
        }

        $form_image = $this->UserImageUpload($request->file, 'form_images/');

        $new_form_image = new FormImage();

        $new_form_image->general_form_id = $form_id;
        $new_form_image->uploaded_image = $form_image;

        $new_form_image->save();

        return response()->api(StatusCode::TRUE, 'Image uploaded successfully', null);
    }

    /**
     * Get all the forms in descending order
     * @return mixed
     */
    public function getForms()
    {
        $form_details = GeneralForm::latest()->get()->toArray();

        return response()->api(StatusCode::TRUE, 'form details fetched successfully',[
            'form_details' => $form_details
        ]);
    }

    /**
     * Get all the images uploaded under single form id
     * @param $form_id
     * @return mixed
     */
    public function getImages($form_id)
    {
        $form = GeneralForm::find($form_id);

        if(false == $form){
            return response()->api(StatusCode::FALSE, 'Invalid form id', null);
        }

        $form_images = FormImage::getByForm_id($form_id)->toArray();

        return response()->api(StatusCode::TRUE, 'form images fetched successfully',[
            'form_images' => $form_images
        ]);
    }
}
