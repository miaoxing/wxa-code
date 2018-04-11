import React from 'react';
import ReactDOM from 'react-dom';
import {Button, Modal} from 'react-bootstrap';
import {Page, PageHeader, SearchForm, SearchItem, DataTable} from 'components';
import rp from 'require-promise';
import 'jquery-update-event';
import bootbox from 'comps/bootbox/bootbox';

const loader = Promise.all([
  import('query-url'),
  import('datatables-net-mx'),
  rp('daterangepicker'),
]);

class WxaCodesIndex extends React.Component {
  constructor(props, context) {
    super(props, context);

    this.handleShow = this.handleShow.bind(this);
    this.handleClose = this.handleClose.bind(this);

    this.state = {
      show: false
    };
  }

  handleClose() {
    this.setState({ show: false });
  }

  handleShow() {
    this.setState({ show: true });
  }

  componentDidMount() {
    loader.then(() => {
      const $table = $('.js-wxa-code-table').dataTable({
        searchEl: '.js-wxa-code-form',
        searchEvent: 'update',
        ajax: {
          url: $.queryUrl2('admin/wxa-codes.json')
        },
        order: [],
        columns: [
          {
            title: '名称',
            data: 'name'
          },
          {
            title: '路径',
            data: 'path'
          },
          {
            title: '宽度',
            data: 'width',
          },
          /*{
            title: '自动配置线条颜色',
            data: 'autoColor',
            render: function (data) {
              return data ? '是' : '否';
            }
          },
          {
            title: '颜色',
            data: 'lineColor'
          },*/
          {
            title: '扫描次数',
            data: 'scanCount'
          },
          {
            title: '扫描人数',
            data: 'scanUser'
          },
          {
            title: '创建时间',
            data: 'createdAt'
          },
          {
            title: '操作',
            data: 'id',
            createdCell: (td, val) => {
              ReactDOM.render(<span>
                <a className="js-show-image" href="javascript:" data-id={val}>查看</a>
                {' '}
                <a href={$.url('admin/wxa-codes/%s/edit', val)}>修改</a>
                {' '}
                <a className="js-delete-record text-danger" href="javascript:"
                  data-href={$.url('admin/wxa-codes/%s/destroy', val)}>删除</a>
              </span>, td);
            }
          }
        ]
      });

      $table.deletable();

      var that = this;
      $table.on('click', '.js-show-image', function () {
        var url = $.url('admin/wxa-codes/%s/show-image', $(this).data('id'));
        that.handleShow();
        $('.js-wxa-code-image').attr('src', url);
        $('.js-wxa-code-download').attr('href', url + '?download=1');
      });
    });
  }

  render() {
    return (
      <Page>
        <PageHeader>
          <Button bsStyle="success" href={$.url('admin/wxa-codes/new')}>添加小程序码</Button>
        </PageHeader>

        <SearchForm className="js-wxa-code-form">

          <SearchItem label="名字" name="name"/>

          <SearchItem label="路径" name="path"/>
        </SearchForm>

        <DataTable className="js-wxa-code-table"/>

        <Modal show={this.state.show} onHide={this.handleClose}>
          <Modal.Header closeButton>
            <Modal.Title>查看小程序码</Modal.Title>
          </Modal.Header>
          <Modal.Body className="text-center">
            <img className="js-wxa-code-image" src=""/>
          </Modal.Body>
          <Modal.Footer>
            <a className="js-wxa-code-download btn btn-default">下载</a>
            <Button onClick={this.handleClose}>关闭</Button>
          </Modal.Footer>
        </Modal>
      </Page>
    )
  }
}

export default WxaCodesIndex;
