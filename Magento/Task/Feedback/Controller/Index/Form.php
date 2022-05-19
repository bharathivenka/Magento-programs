<?php
namespace Task\Feedback\Controller\Index;

use Magento\Framework\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Task\Feedback\Helper\Sendmail;
use Task\Feedback\Model\FeedbackFactory;


class Form extends Action\Action
{
    /** @var PageFactory */
    protected $_pageFactory;

    /** @var FeedbackFactory */
    protected $_feedbackFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory,
        FeedbackFactory $feedbackFactory
       
    )
    {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
        $this->_feedbackFactory = $feedbackFactory;
    }

    public function execute()
    {
        $page   = $this->_pageFactory->create();
        $post   = (array) $this->getRequest()->getPost();
        if($post) {

            if ($this->submit($post)) {
                $this->_redirect('/');
                $this->messageManager->addSuccessMessage('YOUR FEEDBACK IS SUBMITTED SUCCESSFULLY');


            }
        }

        return $page;

    }

    /**
     * Form Submission
     * @param $post
     * @return bool
     */

    private function submit($post)
    {
        try {
            $form = $this->_feedbackFactory->create();
            $form->addData($post)
                ->save();
            return true;
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong! Your feedback has not submitted. Please try again.'));
        }

        return false;
    }

}
