<?php

namespace app\modules\api\controllers;

use app\models\Comment;
use app\models\CommentSearch;
use Yii;
use yii\data\ActiveDataFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\rest\ActiveController;

/**
 * @SWG\Swagger(
 *     basePath="/api",
 *     produces={"application/json"},
 *     consumes={"application/json"},
 *     @SWG\Info(version="1.0", title="Simple API"),
 * )
 */
class CommentController extends ActiveController
{
    public $modelClass = 'app\models\Comment';

    /**
     * @SWG\Get(path="/comments",
     *     tags={"Comments"},
     *     summary="Retrieves the collection of Comments resources.",
     *     @SWG\Parameter(
     *         name="filter[subject]",
     *         in="query",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="filter[subject_id]",
     *         in="query",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="filter[username]",
     *         in="query",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="filter[created_at]",
     *         in="query",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Comment collection response",
     *         @SWG\Schema(ref = "#/definitions/Comment")
     *     ),
     * )
     */

    /**
     * @SWG\Get(path="/comments/{id}",
     *     tags={"Comments"},
     *     summary="Retrieves the collection of Comments resources.",
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         description="id",
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Comment collection response",
     *         @SWG\Schema(ref = "#/definitions/Comment")
     *     ),
     * )
     */

    /**
     * @SWG\Post(path="/comments",
     *     tags={"Comments"},
     *     summary="Create new Comment resource.",
     *     @SWG\Parameter(
     *         name="fields",
     *         in="body",
     *         required=true,
     *         @SWG\Schema(ref = "#/definitions/Comment")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Comment collection response",
     *         @SWG\Schema(ref = "#/definitions/Comment")
     *     ),
     * )
     */
    public function actions(): array {
        $actions = parent::actions();

        $actions['index']['prepareDataProvider'] = function () {
            $filter = new ActiveDataFilter([
                'searchModel' => 'app\models\CommentSearch',
            ]);

            $filterCondition = null;
            // You may load filters from any source. For example,
            // if you prefer JSON in request body,
            // use Yii::$app->request->getBodyParams() below:
            if ($filter->load(Yii::$app->request->get())) {
                $filterCondition = $filter->build();

                if ($filterCondition === false) {
                    // Serializer would get errors out of it
                    return $filter;
                }
            }

            $query = Comment::find();
            if ($filterCondition !== null) {
                $query->andWhere($filterCondition);
            }

            return new ActiveDataProvider([
                'query' => $query,
            ]);
        };

        return $actions;
    }
}
