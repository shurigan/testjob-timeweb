<?php

namespace Parser\Controller;

use Core\Controller\BaseController,
    Core\RequestInterface;
use Core\Response\ResponseInterface,
    Core\Response\JsonResponse,
    Core\Response\Response;
use Core\View\BaseView;
use Core\View\Engine\ViewEngineTwig;
use DB\DB;
use Debug\Debug;
use Parser\Parser\HttpParser,
    Parser\Rules\TextParserRule,
    Parser\Rules\ImagesParserRule,
    Parser\Rules\LinksParserRule;
use Parser\Entity\ParseResult;

/**
 * Class ParserController
 * @package Parser\Controller
 */
class ParserController extends BaseController {

    /**
     * Index action
     *
     * @param RequestInterface $request
     * @param string $type
     * @param string $url
     * @return ResponseInterface
     */
    public function actionForm($request, $type, $url) {
        $view = $this->getApplication()->getView()->render('form', array(
            "type" => $type,
            "url"  => $url
        ));

        return $this->getApplication()->getResponse()->setBody($view);
    }

    /**
     * List action
     *
     * @param RequestInterface $request
     * @param int $page
     * @return ResponseInterface
     */
    public function actionList($request, $page) {
        $results = ParseResult::findAll();

        $results = array_reverse($results);

        $view = $this->getApplication()->getView()->render('results', array(
            'results' => $results
        ));

        return $this->getApplication()->getResponse()->setBody($view);
    }

    /**
     * Item action
     *
     * @param RequestInterface $request
     * @param int $id
     * @return ResponseInterface
     */
    public function actionItem($request, $id) {
        $item = ParseResult::getById($id);

        $view = new BaseView(new ViewEngineTwig());

        $response = $this->getApplication()->getResponse()->setBody($view->render('parse/item', array(
            'url' => $item->getUrl(),
            'results' => $item->getResults(),
            'total' => $item->getTotal()
        )));

        return $response;
    }


    /**
     * Validate form values
     *
     * @param string $url
     * @param string $type
     * @param string $text
     * @return array|bool false if valid otherwise errors array
     */
    protected function validateFormValues($url, $type, $text) {
        $errors = array();

        if(empty($url) || !preg_match("|^(https?://)?([\w]+.)+[\w]+\.?(\?.*)?$|is", $url)) {
            $errors[] = array(
                'field' => 'url',
                'message' => 'Не валидный урл'
            );
        }

        if(!in_array($type, array("text", "links", "images"))) {
            $errors[] = array(
                'field' => 'type',
                'message' => 'Ищем только текст, картинки и ссылки, а не - ' . $type
            );
        }

        if("text" == $type && empty($text)) {
            $errors[] = array(
                'field' => 'text',
                'message' => 'Текст не должен быть пустым'
            );
        }
        return count($errors) ? $errors : false;
    }


    /**
     * Parse action
     *
     * @param RequestInterface $request
     * @param string $type
     * @return ResponseInterface
     */
    public function actionParse($request, $type) {
        $response = new JsonResponse();

        $this->getApplication()->setResponse($response);

        Debug::enable(false);

        $url = $request->getRequestVar("url");
        $text = $request->getRequestVar("text");

        $data = array();

        if($errors = $this->validateFormValues($url, $type, $text)) {
            $data = array(
                'status' => 'error',
                'errors' => $errors
            );
        } else {
            $parser = new HttpParser();

            switch($type) {
                case "text":
                    $parser->addRule(new TextParserRule($text));
                    break;
                case "images":
                    $parser->addRule(new ImagesParserRule());
                    break;
                case "links":
                    $parser->addRule(new LinksParserRule());
                    break;
            }

            $results = $parser->process($url);

            if($errors = $parser->getError()) {
                $data = array(
                    'status' => 'error',
                    'errors' => $errors
                );
            } else {
                $parseResult = new ParseResult();

                $parseResult->setUrl($url);
                $parseResult->setResults($results);
                $parseResult->save();

                $data = array(
                    'status' => 'ok',
                );

                $view = new BaseView(new ViewEngineTwig());
                $response->setBody($view->render('parse/result', array(
                    'url' => $parseResult->getUrl(),
                    'results' => $parseResult->getResults(),
                    'total' => $parseResult->getTotal()
                )));
            }

        }

        return $response->setData($data);
    }

} 