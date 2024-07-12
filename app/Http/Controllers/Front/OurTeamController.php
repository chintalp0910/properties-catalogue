<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OurTeamController extends Controller
{
    /**
     * @param Collection $employerList
     * @param int $categoryId
     * @return Collection
     */
    public static function fetchCategory(Collection $employerList, int $categoryId )
    {
        return $employerList->where('office_type_id', $categoryId);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->search;
            $department = $request->department;

            $employers = Employer::select('employers.*', 'employers_categories.title', 'employers_categories.a4a_sort')
                ->where(function ($query) use ($search) {
                    if (!empty($search)) {
                        $query->where('first_name', 'LIKE', '%' . $search . '%')
                            ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                            ->orWhereRaw('CONCAT_WS(" ", first_name, last_name) like "%' . $search . '%"');
                    }
                })->where(function ($query) use ($department) {
                    if (!empty($department) && $department != 'ALL') {
                        $query->where('employers_categories.title', $department);
                    }
                })
                ->leftJoin('employers_categories', 'employers_categories.id', '=', 'employers.category')
                ->get()->orderBy("employers_categories.a4a_sort", "asc")->groupBy('title');

            $html = '';
            $data = [];
            $src = '';
            if ($employers->count() > 0) {
                foreach ($employers as $cat => $employee_list) {
                    $html  = '<div class="team-properties">';
                    $html .= '<div class="properties-title-border">';
                    $html .= '<h2>' . $cat . '</h2>';
                    $html .= '</div>';
                    $html .= '<div class="leasing-contact">';
                    $html .= '<div class="contact-box-inner d-flex flex-wrap">';
                    foreach ($employee_list as $employee) {
                        if (!empty($employee->image_relative_url) && File::exists(public_path('employer_image/' . $employee->image_relative_url . ''))) {
                            $src = asset('employer_image/' . $employee->image_relative_url . '');
                        } else {
                            $src = asset('app-assets/images/ico/favicon-icon.png');
                        }
                        $html .= '<div class="contact-box ">';
                        $html .= '<div class="name">';
                        $html .= '<div class="left">';
                        $html .= '<div class="team-title">';
                        $html .= '<h4>' . $employee->first_name . ' ' . $employee->last_name . '</h4>';
                        $html .= '<span>' . $employee->position ?? '' . '</span>';
                        $html .= '</div>';
                        $html .= '<div class="contact-add">';
                        $html .= '<ul>';
                        $html .= '<li>';
                        $html .= '<i class="fas fa-phone-alt"></i><a href="tel:' . $employee->phone . '">' . self::formatUSAPhone($employee->phone) . '</a>';
                        $html .= '</li>';
                        $html .= '<li>';
                        $html .= '<i class="fas fa-envelope"></i><a href="mailto:' . $employee->email . '">' . $employee->email . '</a>';
                        $html .= '</li>';
                        $html .= '</ul>';
                        $html .= '</div>';
                        $html .= '</div>';
                        $html .= '<div class="right">';
                        $html .= '<div class="image-wrap">';
                        $html .= '<img src="' . $src . '">';
                        $html .= '</div>';
                        $html .= '</div>';
                        $html .= '</div>';
                        $html .= '</div>';
                    }
                    array_push($data, $html);
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                }
            }

            return response()->json([
                'status' => 'SUCCESS',
                'data' => $data,
            ]);
        }

        $employers = Employer::query()->with('office_type')->
            select('employers.*', 'employers_categories.id as employers_category_id', 'employers_categories.title', 'employers_categories.a4a_sort as category_sort')
            ->leftJoin('employers_categories', 'employers_categories.id', '=', 'employers.category')
            ->orderBy("employers.a4a_sort", "asc")
            ->get()
            ->groupBy('title')
            ->sortBy(function ( Collection $grp){
                return $grp->first()->category_sort;
            });
            
        return view('Front.team', [
            'employers' => $employers,
            'og_title' => 'Our Team - Paramount Realty',
            'og_description' => 'Our Team - Paramount Realty, Principals, Legal, Pennsylvania Office, Leasing & Sales, Land Acquisitions/Development, Construction, Property Management, Accounting, Financing, Marketing, Administrative',
        ]);
    }
}
