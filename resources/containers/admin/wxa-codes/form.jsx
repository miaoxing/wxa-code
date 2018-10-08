import React from 'react';
import {Button, Form} from 'react-bootstrap';
import {FormAction, FormItem, Page, PageHeader} from 'components';

const loader = Promise.all([
  import('jquery-populate'),
  import('jquery-form'),
  import('jquery-validation-mx'),
  import('bootstrap-maxlength-mx')
]);

class WxaCodesForm extends React.Component {
  componentDidMount() {
    loader.then(() => {
      $('.js-wxa-code-form')
        .populate(wei.wxaCode)
        .ajaxForm({
          url: $.url('admin/wxa-codes/update'),
          dataType: 'json',
          beforeSubmit: (arr, $form) => $form.valid(),
          success: (ret) => {
            $.msg(ret, () => {
              if (ret.code === 1) {
                window.location = $.url('admin/wxa-codes');
              }
            });
          }
        })
        .validate();

      $('.js-maxlength').maxlength();
    });
  }

  render() {
    return (
      <Page>
        <PageHeader>
          <Button href={$.url('admin/wxa-codes')}>返回列表</Button>
        </PageHeader>
        <Form horizontal className="js-wxa-code-form" method="post">
          <FormItem label="名称" className="js-maxlength" name="name" data-rule-maxlength={16} />

          <FormItem label="路径" className="js-maxlength" name="path" data-rule-maxlength={128} required />

          <FormItem label="宽度" name="width" type="number" help="默认为430" />

          {/*<FormItem label="自动配置线条颜色" name="autoColor" type="radio"></FormItem>*/}

          <input type="hidden" id="id" name="id" />

          <FormAction url={$.url('admin/wxa-codes')} />
        </Form>
      </Page>
    );
  }
}

export default WxaCodesForm;
