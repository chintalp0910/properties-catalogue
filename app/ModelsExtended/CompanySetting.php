<?php

namespace App\ModelsExtended;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CompanySetting extends \App\Models\CompanySetting
{
    /**
     * @return Builder|Model|CompanySetting
     */
    public static function getSetting(): Model|CompanySetting|Builder
    {
        return self::query()->firstOrCreate([
            'title' => 'WHO WE ARE',
            'description' => 'Paramount Realty is a commercial real estate company with over 150 properties and 15 million square feet spanning 10 states across the Northeast and Mid-Atlantic region of the United States. Paramount specializes in shopping centers, single tenant and mixed-use developments, and professional medical and office campuses. Paramount is a trusted preferred developer and partner of leading national and regional companies. We have established ourselves as one of the largest single-tenant developers along the east coast.

Paramount remains committed to its core philosophy of combining local knowledge with broad and deep experience, and a dedication to maintaining strong personal relationships with our tenants, clients, partners, and investors. Our team of over 60 industry leading professionals is highly focused on the core function of creating, maximizing, and sustaining value. We handle all day-to-day operations of each asset in-house, including leasing, property management, finance, accounting, legal, construction management, and marketing.

We know the importance of being hands-on and as a result we have expanded our on-site management services and in-house team to provide best-in-class services to our tenants and communities we serve. We enjoy the benefit of years of experience with our industry best development and construction management teams. Our strengths include site selection, land acquisition, zoning, plan review, cost estimating, bidding, and construction oversight.

Paramount continues to adapt to a radically shifting commercial real estate landscape. Building our portfolio has always required a balance of patience and conservatism. Our team negotiates fairly, accurately, flexibly, and quickly, with an eye on long-term stability and success. Along the way we have forged long lasting partnerships which has proven to be a successful formula for over 30 years.

To us - integrity, vision, and & relationships are paramount.',
    		'p_image' => 'p-big-1-1.png',
		    'map_image' => 'company_map_image_new.png'
        ]);
    }
}