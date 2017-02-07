<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Input;
use Datatables;
use Validator;
use DB;
use Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;
use App\Models\User;
use App\Models\UserIdentity;
use App\Models\OrderApplicant;
use App\Models\TailorRequest;
use App\Http\Requests\Backend\UserCreateFormRequest;
use App\Http\Requests\Backend\UserEditFormRequest;
use App\Http\Requests\Backend\RatingEditFormRequest;

class UserController extends BackendController
{
    public function index(Request $request) {
        return view('backend.user.index');
    }

    public function indexDt(Request $request) {
        $model = User::GetUsers();

        return Datatables::of($model)
            ->filter(function ($model) {
                return $model->GetFilteredResults();
            })
            ->addColumn('actions', function ($model) {
                $actions = buildRemoteLinkHtml([
                    'url' => route('backend.user.edit', ['member_id' => $model->id]),
                    'description' => '<i class="fa fa-pencil"></i>',
                    'modal' => '#remote-modal',
                ]);
                $actions .= buildConfirmationLinkHtml([
                    'url' => route('backend.user.delete', ['member_id' => $model->id]),
                    'description' => '<i class="fa fa-trash"></i>',
                ]);
				$actions .= buildRemoteLinkHtml([
                    'url' => route('backend.user.info', ['member_id' => $model->id]),
                    'description' => '<i class="fa fa-info"></i>',
                    'modal' => '#remote-modal',
                ]);
				$actions .= buildLinkHtml([
                    'url' => route('backend.user.rating', ['member_id' => $model->id]),
                    'description' => '<i class="fa fa-star"></i>',
                    'modal' => '#remote-modal',
                ]);
                return $actions;
            })
            ->make(true);
    }

    public function create(Request $request) {
        return view('backend.user.create');
    }

    public function createPost(UserCreateFormRequest $request) {
        try {
            $model = new User();
            $model->email = $request->get('email');
            $model->password = $request->get('password');
			$model->real_name = $request->get('real_name');
			$model->date_of_birth = $request->get('birth_date');
			$model->experience = $request->get('work_experience');
			$model->handphone_no = $request->get('handphone');
			$model->address = $request->get('address');
			$model->gender = $request->get('gender');
			$model->comment_rating = $request->get('comment_rating');
			$model->account_balance = $request->get('account_balance');

            $model->save();
            return makeResponse('成功新增会员');
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function edit($id) {
        $model = User::find($id);

        return view('backend.user.edit', ['model' => $model]);
    }

    public function editPost(UserEditFormRequest $request, $id) {
        $model = User::GetUsers()->find($id);

        if (!$model) {
            return makeResponse('会员不存在', true);
        }

        try {
            $model->email = $request->get('email');
            if ($request->has('password') && $request->get('password') != '') {
                $model->password = $request->get('password');
            }

            //Check for email exists
            $email_exists = User::where('email', '=', $model->EMAIL)->where('id', '!=', $model->id)->exists();
            if ($email_exists) {
                throw new \Exception('电子邮件地址已被注册');
            }
			
			$model->real_name = $request->get('real_name');
			$model->date_of_birth = $request->get('birth_date');
			$model->experience = $request->get('work_experience');
			$model->handphone_no = $request->get('handphone');
			$model->address = $request->get('address');
			$model->gender = $request->get('gender');
			$model->comment_rating = $request->get('comment_rating');
			$model->account_balance = $request->get('account_balance');

            $model->save();
            return makeResponse('成功编辑会员');
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function delete($id) {
        $model = User::find($id);

        try {
            if ($model->delete()) {
                return makeResponse('成功删除会员');
            } else {
                throw new \Exception('未能删除会员，请稍候再试');
            }
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }
	
	public function submitID() {
		return view('backend.user.submitid');		
	}
	
	public function submitIDDt() {
		$model = UserIdentity::where('status', 0);

        return Datatables::of($model)
			->addColumn('email', function ($model) {
                return $model->getOwnerEmail();
            })
			->addColumn('gender_text', function ($model) {
                return $model->getGenderText();
            })
			->addColumn('images', function ($model) {
				$images = '';
				if ($model->getIdImageFront() != null) {
					$images .= '<a href="' . $model->getIdImageFront() . '" class="btn btn-xs purple btn-image-view">Front</a>';
				}
				if ($model->getIdImageBack() != null) {
					$images .= '<a href="' . $model->getIdImageBack() . '" class="btn btn-xs green btn-image-view">Back</a>';
				}
				
				return $images;
			})
            ->filter(function ($model) {
                return $model->GetFilteredResults();
            })
            ->addColumn('actions', function ($model) {
                $actions = buildConfirmationLinkHtml([
                    'url' => route('backend.user.approve.id', ['request_id' => $model->id]),
                    'description' => '<i class="fa fa-check"></i>',
                ]);
                $actions .= buildConfirmationLinkHtml([
                    'url' => route('backend.user.reject.id', ['request_id' => $model->id]),
                    'description' => '<i class="fa fa-remove"></i>',
                ]);
                return $actions;
            })
            ->make(true);		
	}

	/**
	 * approve a user's identity request
	 */
	public function approveId($id) {
        $model = UserIdentity::find($id);
		$model->status = 1;

        try {
            if ($model->save()) {
				$user = User::find($model->user_id);
				$user->is_validated = 1;
				$user->is_tailor = 1;
				if ($user->save()) {
					return makeResponse('成功删除会员');
				} else {
	                throw new \Exception('未能删除会员，请稍候再试');
	            }					
            } else {
                throw new \Exception('未能删除会员，请稍候再试');
            }
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }
	
	/**
	 * reject a user's identity request
	 */
	public function rejectId($id) {
        $model = UserIdentity::find($id);
		$model->status = 2;

        try {
            if ($model->save()) {
                return makeResponse('成功删除会员');
            } else {
                throw new \Exception('未能删除会员，请稍候再试');
            }
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }
	
	/**
	 * list of requests from tailors
	 */
	public function tailorRequest() {
		return view('backend.user.tailor_request');		
	}
	
	/**
	 * implement datatable for tailor request list
	 */
	public function tailorRequestDt() {
		$model = TailorRequest::where('status', 0);

        return Datatables::of($model)
			->addColumn('email', function ($model) {
                return $model->getOwnerEmail();
            })
            ->filter(function ($model) {
                return $model->GetFilteredResults();
            })
            ->addColumn('actions', function ($model) {
                $actions = buildConfirmationLinkHtml([
                    'url' => route('backend.user.approve.tailor.id', ['request_id' => $model->id]),
                    'description' => '<i class="fa fa-check"></i>',
                ]);
                $actions .= buildConfirmationLinkHtml([
                    'url' => route('backend.user.reject.tailor.id', ['request_id' => $model->id]),
                    'description' => '<i class="fa fa-remove"></i>',
                ]);
                return $actions;
            })
            ->make(true);		
	}
	
	/**
	 * approve a user's tailor request
	 */
	public function approveTailor($id) {
        $model = TailorRequest::find($id);
		$model->status = 1;

        try {
            if ($model->save()) {
                return makeResponse('成功删除会员');
            } else {
                throw new \Exception('未能删除会员，请稍候再试');
            }
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }
	
	/**
	 * reject a user's tailor request
	 */
	public function rejectTailor($id) {
        $model = TailorRequest::find($id);
		$model->status = 2;

        try {
            if ($model->save()) {
                return makeResponse('成功删除会员');
            } else {
                throw new \Exception('未能删除会员，请稍候再试');
            }
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }
    
    /**
	 * view rating and level of user
	 */
	public function info($id) {
        $model = User::find($id);

        return view('backend.user.info', ['rating' => round($model->getRating()), 'level' => $model->getLevel()]);
    }
	
	/**
	 * view rating list of user
	 */
	public function rating($id) {
		$model = User::find($id);
		return view('backend.user.rating', ['model' => $model]);		
	}
	
	public function ratingDt(Request $request) {
        $model = OrderApplicant::GetOrderApplicant()
        	->where('rate_quality', '>', 0)
			->where('rate_communicate', '>', 0)
			->where('rate_speed', '>', 0)
			->where('status', 1);

        return Datatables::of($model)
            ->filter(function ($model) {
                return $model->GetFilteredResults();
            })
			->addColumn('order', function ($model) {
				return $model->getOrderId();
			})
            ->addColumn('actions', function ($model) {
                $actions = buildRemoteLinkHtml([
                    'url' => route('backend.user.rating.edit', ['rating_id' => $model->id]),
                    'description' => '<i class="fa fa-pencil"></i>',
                    'modal' => '#remote-modal',
                ]);
                $actions .= buildConfirmationLinkHtml([
                    'url' => route('backend.user.rating.delete', ['rating_id' => $model->id]),
                    'description' => '<i class="fa fa-trash"></i>',
                ]);
                return $actions;
            })
            ->make(true);
    }

	public function ratingEdit($id) {
        $model = OrderApplicant::find($id);

        return view('backend.user.rating_edit', ['model' => $model]);
    }
	
	public function ratingEditPost(RatingEditFormRequest $request, $id) {
        $model = OrderApplicant::GetOrderApplicant()->find($id);

        if (!$model) {
            return makeResponse('会员不存在', true);
        }

        try {
            $model->rate_quality = floatval($request->get('rate_quality'));
           	$model->rate_communicate = floatval($request->get('rate_communicate'));
			$model->rate_speed = floatval($request->get('rate_speed'));
			$model->text_review = $request->get('text_review');

            $model->save();
            return makeResponse('成功编辑会员');
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }
	
	public function ratingDelete($id) {
        $model = OrderApplicant::find($id);

        try {
        	$model->rate_quality = 0;
           	$model->rate_communicate = 0;
			$model->rate_speed = 0;
			$model->text_review = '';

            if ($model->save()) {
                return makeResponse('成功删除会员');
            } else {
                throw new \Exception('未能删除会员，请稍候再试');
            }
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }
}
