import React from 'react';
import ReactDOM from 'react-dom';
import {Button} from 'react-bootstrap';
import {DataTable, Page, PageHeader, SearchForm, SearchItem} from 'components';
import 'jquery-update-event';

const loader = Promise.all([
  import('query-url'),
  import('datatables-net-mx')
]);

class WxaCodesIndex extends React.Component {
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
            createdCell: (td, val, full) => {
              ReactDOM.render(<span>
                <a className="js-wxa-code-show" href="javascript:" data-path={full.path}>查看</a>
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

    $('body').on('click', '.js-wxa-code-show', function () {
      var url = $.url('admin/wxa-codes/show-image', {path: $(this).data('path')});
      $('.js-wxa-code-image').attr('src', url);
      $('.js-wxa-code-download').attr('href', $.appendUrl(url, {download: 1}));
      $('.js-wxa-code-modal').modal('show');
    });
  }

  render() {
    return (
      <Page>
        <PageHeader>
          <Button variant="success" href={$.url('admin/wxa-codes/new')}>添加小程序码</Button>
        </PageHeader>

        <SearchForm className="js-wxa-code-form">

          <SearchItem label="名字" name="name"/>

          <SearchItem label="路径" name="path"/>
        </SearchForm>

        <DataTable className="js-wxa-code-table"/>

        <div className="js-wxa-code-modal modal fade" tabIndex="-1" role="dialog" aria-labelledby="wxa-code-modal-label"
          aria-hidden="true">
          <div className="modal-dialog">
            <div className="modal-content">
              <div className="modal-header">
                <button type="button" className="close" data-dismiss="modal">
                  <span aria-hidden="true">&times;</span><span className="sr-only">Close</span>
                </button>
                <h4 className="modal-title" id="wxa-code-modal-label">查看小程序码</h4>
              </div>
              <div className="modal-body text-center">
                <img className="js-wxa-code-image img-max"/>
              </div>
              <div className="modal-footer">
                <a className="js-wxa-code-download btn btn-success">下载</a>
                <button type="button" className="btn btn-default" data-dismiss="modal">关闭</button>
              </div>
            </div>
          </div>
        </div>
      </Page>
    )
  }
}

export default WxaCodesIndex;
