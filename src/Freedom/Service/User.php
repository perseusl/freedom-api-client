<?php namespace AnyTV\Freedom\Service;

use \Exception;

class User extends Service {

    public function getUser($id = null)
    {
        $this->request->get('/user/' . $id);

        if ($this->request->response['statusCode'] !== 200) {
            throw new Exception ($this->request->response['data']);
        }

        if (gettype($this->request->response['data']) === 'string') {
            return json_decode($this->request->response['data'], true);
        }

        return $this->request->response['data'];
    }

/*  commenting this because of its absence in the backend
    public function getActivities()
    {
    	$this->request->get('/activities');

    	return $this->request->response;
    
    }*/

    public function getUserInfo()
    {
    	$this->request->get('/user');

    	return $this->request->response;
    }

    public function updateUserInfo($payload)
    {
    	$payload = $this->requires($payload, [], [
    		'lname',
    		'fname',
    		'birthdate',
    		'skype',
    		'google_refresh_token',
    		'street_address',
    		'city',
    		'state',
    		'country',
    		'postal_code',
    		'avatar',
    		'facebook',
    		'twitter',
    		'phone'
		]);
		
		$this->request->setPayload($payload);
    	$this->request->put('/user');

    	return $this->request->response;
    }

    public function getRecruits()
    {
    	$this->request->get('/recruits');

	  	return $this->request->response;
    }

    public function getRecruitsWithChannel($query)
    {
    	$query = $this->requires($query, ['has_channels']);

    	$this->request->setQueryString($query);
    	$this->request->get('/recruits');
    	
	  	return $this->request->response;
    }

/*  currently not in used in freedom-mnl, also not present in backend
    public function findRecruit($recruit_id, $query)
    {

    	$recruit_id = $this->requires(['recruit_id' => $recruit_id ], ['recruit_id']);
		$query = $this->requires($query, [], ['has_channels']);

    	$this->request->setQueryString($query);
    	$this->request->get('/recruits/search/' . $recruit_id['recruit_id']);

    	return $this->request->response;
    }*/

/*  as per esh, do not include earnings for now  
    public function getRecruitEarnings($query)
    {
    	$query = $this->requires($query, [], ['report_id']);

    	$this->request->setQueryString($query);
    	$this->request->get('/earnings/recruits');

    	return $this->request->response;
    }*/

    public function findProspect($prospect_id)
    {
    	$prospect_id = $this->requires(['prospect_id' => $prospect_id ], ['prospect_id']);
		
    	//$this->request->setQueryString($query);
    	$this->request->get('/prospect/search/' . $prospect_id['prospect_id']);

    	return $this->request->response;
    }

    public function addProspect($payload)
    {
		$payload = $this->requires($payload, [
    		'username',
    		'owner',
    		'thumbnail'
		]);
		
		$this->request->setPayload($payload);
    	$this->request->post('/prospect');

    	return $this->request->response;
    }

    public function getUserProspects()
    {
    	$this->request->get('/prospects');

    	return $this->request->response;
    }

    public function updateProspect($prospect_id, $payload)
    {
    	$prospect_id = $this->requires(['prospect_id' => $prospect_id ], ['prospect_id']);
		$payload = $this->requires($payload, [
    		'status',
    		'note'
		]);

    	$this->request->setPayload($payload);
    	$this->request->put('/prospect/'. $prospect_id['prospect_id']);

    	return $this->request->response;
    }

    public function deleteProspects($query)
    {	
    	$query = $this->requires($query, ['ids']);

    	$this->request->setQueryString($payload);
    	$this->request->delete('/prospects');

    	return $this->request->response;
    }

    public function acceptPartnershipContract()
    {
    	$this->request->post('/accept_partnership_contract');

    	return $this->request->response;
    }

    public function joinRecruiterNetwork()
    {
    	$this->request->post('/apply/recruiter');
    	
    	return $this->request->response;
    }

    public function logout()
    {
    	$this->request->get('/logout');
    	
    	return $this->request->response;
    }

    public function getXsplitCode()
    {
    	$this->request->post('/sponsorship/xsplit/get_code');
    	
    	return $this->request->response;
    }

    public function getXsplitExtCode()
    {
    	$this->request->post('/sponsorship/xsplit/get_code_ext');
    	
    	return $this->request->response;
    }

    public function getXsplitCodeCount()
    {
    	$this->request->get('/sponsorship/xsplit/count');
    	
    	return $this->request->response;
    }

    public function checkVideoReview()
    {
    	$this->request->get('/sponsorship/xsplit/has_video_review');
    	
    	return $this->request->response;
    }


    public function submitVideoReview($payload)
    {
    	$payload = $this->requires($payload, ['video_id'], [
    		'title',
    		'image',
    		'campaign_id'
		]);

    	$this->request->setPayload($payload);
    	$this->request->post('/sponsorship/xsplit/submit_video_review');

    	return $this->request->response;
    }

    public function updateXsplitName($payload)
    {
    	$payload = $this->requires($payload, ['username'] );

    	$this->request->setPayload($payload);
    	$this->request->put('/sponsorship/xsplit/update_username');

    	return $this->request->response;
    }

    public function submitSponsorApplication($payload)
    {
    	$payload = $this->requires($payload, [
    		'name',
    		'mailing_address',
    		'email',
    		'channel_id',
    		'skype',
    		'sponsor_id',
    		'sponsor_name'
		]);

    	$this->request->setPayload($payload);
    	$this->request->post('/sponsorship');

    	return $this->request->response;
    }

    public function getFreedomPoints()
    {
    	$this->request->get('/points');
    	
    	return $this->request->response;
    }

    public function computeFreedomPoints()
    {
    	$this->request->put('/points/compute');
    	
    	return $this->request->response;
    }

    public function submitSpotlightVideo($payload)
    {
    	$payload = $this->requires($payload, [
    		'video_id',
    		'reason'
		]);

    	$this->request->setPayload($payload);
    	$this->request->post('/points/spotlight_vid');

    	return $this->request->response;
    }


    public function registerEvent($payload)
    {
    	$payload = $this->requires($payload, ['name']);

    	$this->request->setPayload($payload);
    	$this->request->post('/points/register_event');

    	return $this->request->response;
    }

    public function bidOnVideo($payload)
    {
    	$payload = $this->requires($payload, [
    		'video_id',
    		'bid'
		]);

    	$this->request->setPayload($payload);
    	$this->request->put('/points/bid');

    	return $this->request->response;
    }

    public function upsertUsername($payload)
    {
    	$payload = $this->requires($payload, [
    		'app',
    		'username'
		]);

    	$this->request->setPayload($payload);
    	$this->request->put('/username');

    	return $this->request->response;
    }

    public function deleteUsername($query)
    {
    	$query = $this->requires($query, ['app']);

    	$this->request->setQueryString($query);
    	$this->request->delete('/username');

    	return $this->request->response;
    }

    public function getUsername($query)
    {
    	$query = $this->requires($query, ['app']);

    	$this->request->setQueryString($query);
    	$this->request->get('/username');

    	return $this->request->response;
    }

    public function sendResetEmail($query)
    {
    	$query = $this->requires($query, ['email']);

    	$this->request->setQueryString($query);
    	$this->request->get('/send_reset_mail');

    	return $this->request->response;
    }

    public function resetEmail($payload)
    {
    	$payload = $this->requires($payload, [
    		'email',
    		'password',
    		'reset_token'
		]);

    	$this->request->setPayload($payload);
    	$this->request->post('/reset_password');

    	return $this->request->response;
    }

    public function loginAsUser($payload) {
        $this->requires($payload, [
        	'user_id',
        	'access_token',
        	'roles'
        ]);

        $this->request->setPayload($payload);
        $this->request->post('/admin/view_as');
        return $this->request->response['data'];
    }

    
}
