<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Candidate;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CandidateResource;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

/**
* @OA\Tag(
*     name="Candidates",
*     description="API Endpoints of Candidates"
* )
*/

class CandidateController extends Controller
{
    public function __construct(Candidate $table)
    {
        $this->table = $table;
    }

    /**
     * @OA\Get(
     *      path="/api/candidates",
     *      operationId="getCandidateList",
     *      tags={"Candidates"},
     *      summary="Get list of candidates",
     *      description="Returns list of candidates",
     *      security={{ "passport":{} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function index()
    {
        return CandidateResource::collection($this->table->all());
    }
    
    /**
     * @OA\Post(
     *      path="/api/candidates",
     *      operationId="storeCandidate",
     *      tags={"Candidates"},
     *      summary="Store new candidate",
     *      description="Returns candidate data",
     *      security={{ "passport":{} }},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *             @OA\Property(property="name", type="string", format="string", example="C Ronaldo"),
     *             @OA\Property(property="email", type="string", format="email", example="c.ronaldo@mail.com"),
     *             @OA\Property(property="birth_date", type="string", format="date", example="2001-07-20"),
     *             @OA\Property(property="phone_number", type="integer", format="int64", example="62819157421"),
     *             @OA\Property(property="experience", type="integer", format="int64", example="5"),
     *             @OA\Property(property="education", type="string", format="string", example="Universitas Gadjah Mada"),
     *             @OA\Property(property="last_position", type="string", format="string", example="CEO"),
     *             @OA\Property(property="applied_position", type="string", format="string", example="Senior PHP Developer"),
     *             @OA\Property(property="skill", type="string", format="string", example="Laravel, Mysql, PostgreSQL, Codeigniter, Java"),
     *             @OA\Property(description="file to upload", property="resume_file",type="file"),
     *             required={"name", "email", "phone_number", "experience", "education", "birth_date", "last_position", "applied_position", "skill", "resume_file"},
     *           )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */

    public function store(Request $request)
    {
        try {
            if(Gate::allows('isSeniorHrd')) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'phone_number' => 'required',
                    'experience' => 'required',
                    'education' => 'required',
                    'birth_date' => 'required|date',
                    'last_position' => 'required',
                    'applied_position' => 'required',
                    'skill' => 'required',
                    'resume_file' => 'required|mimes:pdf'
                ]);

                if($validator->fails()) {
                    return response()->json([
                        'errors' => $validator->messages()
                    ], 400);
                }

                if($request->hasFile('resume_file')) {
                    $path = $request->file('resume_file')->storePublicly('candidates', 'public_upload');
                    $request->merge([
                        'resume' => (isset($path) && !empty($path)) ? $path : null
                    ]);
                }

                $candidate = $this->table->create($request->all());

                return new CandidateResource($candidate);
            } else {
                return response()->json([
                    'message' => 'Forbidden'
                ], 403); 
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Bad Request'
            ], 400);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/candidates/{id}",
     *      operationId="getCandidateById",
     *      tags={"Candidates"},
     *      summary="Get candidate information",
     *      description="Returns candidates data",
     *      security={{ "passport":{} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Candidate id",
     *          required=true,
     *          in="path",
     *          example="5",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     * )
     */

    public function show($id)
    {
        try {
            $candidate = $this->table->find($id);
            if($candidate) {
                return new CandidateResource($candidate);
            } else {
                return response()->json([
                    'message' => 'Data not found'
                ], 404);
            } 
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/candidates/{id}",
     *      operationId="updateCandidate",
     *      tags={"Candidates"},
     *      summary="Update existing candidate",
     *      description="Returns updated candidate data",
     *      security={{ "passport":{} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Candidate id",
     *          required=true,
     *          in="path",
     *          example="5",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *             @OA\Property(property="name", type="string", format="string", example="C Ronaldo"),
     *             @OA\Property(property="email", type="string", format="email", example="c.ronaldo@mail.com"),
     *             @OA\Property(property="birth_date", type="string", format="date", example="2001-07-20"),
     *             @OA\Property(property="phone_number", type="integer", format="int64", example="62819157421"),
     *             @OA\Property(property="experience", type="integer", format="int64", example="5"),
     *             @OA\Property(property="education", type="string", format="string", example="Universitas Gadjah Mada"),
     *             @OA\Property(property="last_position", type="string", format="string", example="CEO"),
     *             @OA\Property(property="applied_position", type="string", format="string", example="Senior PHP Developer"),
     *             @OA\Property(property="skill", type="string", format="string", example="Laravel, Mysql, PostgreSQL, Codeigniter, Java"),
     *             @OA\Property(description="file to upload", property="resume_file",type="file"),
     *             required={"name", "email", "phone_number", "experience", "education", "birth_date", "last_position", "applied_position", "skill"},
     *           )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */

    public function update(Request $request, $id)
    {
        try {
            if(Gate::allows('isSeniorHrd')) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|unique:users,email,'.$id,
                    'phone_number' => 'required',
                    'experience' => 'required',
                    'education' => 'required',
                    'birth_date' => 'required',
                    'last_position' => 'required',
                    'applied_position' => 'required',
                    'skill' => 'required',
                    'resume_file' => 'nullable|mimes:pdf'
                ]);

                if($validator->fails()) {
                    return response()->json([
                        'message' => 'The fields are required',
                        'errors' => $validator->messages()
                    ], 400);
                }

                $candidate = $this->table->find($id);

                if($request->hasFile('resume_file')) {
                    Storage::disk('public_upload')->delete($candidate->resume);
                    $path = $request->file('resume_file')->storePublicly('candidates', 'public_upload');
                    $request->merge([
                        'resume' => (isset($path) && !empty($path)) ? $path : null
                    ]);
                }

                $candidate->update($request->all());

                return response()->json([
                    'message' => 'Candidate has been updated',
                    'data' => new CandidateResource($candidate)
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Forbidden'
                ], 403); 
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }
        
    }

    /**
     * @OA\Delete(
     *      path="/api/candidates/{id}",
     *      operationId="deleteCandidate",
     *      tags={"Candidates"},
     *      summary="Delete existing candidate",
     *      description="Deletes a record and returns no content",
     *      security={{ "passport":{} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Candidate id",
     *          required=true,
     *          in="path",
     *          example="5",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */

    public function destroy($id)
    {
        try {
            if(Gate::allows('isSeniorHrd')) {
                $tb = $this->table->find($id);
                if($tb->resume) {
                    Storage::disk('public_upload')->delete($tb->resume);
                }
                $tb->delete();

                return response()->json([
                    'message' => 'Candidate has been deleted'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Forbidden'
                ], 403); 
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }
    }
}
